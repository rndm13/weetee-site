<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;


class AccountController extends Controller
{
    public function login_form(Request $request): View
    {
        return view('account.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('index');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function register_form(Request $request): View
    {
        return view('account.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'name' => ['required', 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required'],
            'confirm_password' => ['required'],
        ]);

        if ($credentials['password'] != $credentials['confirm_password']) {
            return back()->withErrors([
                'password' => 'Password must be confirmed.',
            ])->withInput(['name', 'email']);
        }

        $user = new User();
        $user->name = $credentials['name'];
        $user->email = $credentials['email'];
        $user->password = Hash::make($credentials['password']);

        $user->save();

        Auth::login($user);

        return to_route('index');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();

        return back();
    }

    public function profile($id): View
    {
        $user = User::find($id);

        if ($user === null) {
            return abort(404);
        }

        $posts = Post::where('user_id', $id)->orderBy('created_at', 'desc')->paginate();
        $comments = Comment::where('user_id', $id)->orderBy('created_at', 'desc')->paginate();

        return view('account.profile', ['user' => $user, 'posts' => $posts, 'comments' => $comments]);
    }

    public function change_password_account(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'password' => ['required'],
            'confirm_password' => ['required'],
        ]);

        if ($credentials['password'] != $credentials['confirm_password']) {
            return back()->withErrors([
                'password' => 'Password must be confirmed.',
            ]);
        }

        $user = User::find(Auth::id());

        if ($user === null) {
            return abort(404);
        }

        if (!Gate::allows('update-account', $user)) {
            return abort(403);
        }

        $user->password = Hash::make($credentials['password']);

        $user->save();

        return back();
    }

    public function edit_account($id, Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'name' => ['required', Rule::unique('users', 'name')->ignore($id)],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($id)],
        ]);

        $user = User::find($id);

        if ($user === null) {
            return abort(404);
        }

        if (!Gate::allows('update-account', $user)) {
            return abort(403);
        }

        $user->name = $credentials['name'];
        $user->email = $credentials['email'];

        $user->save();

        return back();
    }

    public function delete_account($id): RedirectResponse
    {
        $user = User::find($id);

        if ($user === null) {
            return abort(404);
        }

        if (!Gate::allows('delete-account', $user)) {
            return abort(403);
        }

        if (Auth::id() == $id) {
            Auth::logout();
        }

        User::destroy($id);

        return to_route('index');
    }
}
