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
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;

use App\Mail\AccountConfirmation;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

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

        $user = User::find('email', $credentials['email']);

        if ($user !== null && $user->trashed()) {
            return back()->withErrors([
                'email' => 'This user has been banned from this site.',
            ])->onlyInput('email');
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('index');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function google_redirect(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function google_callback(Request $request): RedirectResponse
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
        $user = User::where('email', $googleUser->getEmail())->whereOr('google_id', $googleUser->getId())->first();

        if ($user !== null && $user->trashed()) {
            return to_route('account.login_form')->withErrors([
                'email' => 'This user has been banned from this site.',
            ])->onlyInput('email');
        }

        if ($user === null) {
            $user = new User();

            $user->google_id = $googleUser->getId();
            $user->email_verified_at = Carbon::now();
            $user->email = $googleUser->getEmail();
            $user->name = $googleUser->getName();
            $user->google_token = $googleUser->token;

            if ($googleUser->refreshToken !== null) {
                $user->google_refresh_token = $googleUser->refreshToken;
            }

            $user->save();
        }

        Auth::login($user);
        session()->regenerate();

        return to_route('index');
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

        DB::beginTransaction();

        $user = new User();
        $user->name = $credentials['name'];
        $user->email = $credentials['email'];
        $user->password = Hash::make($credentials['password']);

        $user->account_confirmation_token = Str::random();

        $user->save();

        $link = Url::route('account.confirm', ['email' => $user->email, 'token' => $user->account_confirmation_token]);

        Mail::to($user->email)->send(new AccountConfirmation($link));

        DB::commit();

        Auth::login($user);

        return to_route('index');
    }

    public function account_confirmation(string $email, string $token): RedirectResponse
    {
        $user = User::where('email', $email)->whereAnd('account_confirmation_token', $token)->first();

        if ($user === null) {
            return abort(403);
        }

        $user->email_verified_at = Carbon::now();
        $user->account_confirmation_token = null;

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
            'role' => ['sometimes', 'in:admin,moderator,user'],
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

        if (array_key_exists('role', $credentials)) {
            $user->role = $credentials['role'];
        }

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

        $user->forceDelete();

        return to_route('index');
    }

    public function ban_account($id): RedirectResponse
    {
        $user = User::find($id);

        if ($user === null) {
            return abort(404);
        }

        if (!Gate::allows('ban-account', $user)) {
            return abort(403);
        }

        // TODO: logout the banned user by deleting his session...

        $user->softDelete();

        return back();
    }
}
