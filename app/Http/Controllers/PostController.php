<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function show(int $id): View
    {
        $post = Post::find($id);

        $comments = Comment::where('post_id', $id)->orderBy('created_at', 'desc')->paginate();

        if ($post == null) {
            return http_response_code(404);
        }

        return view('post.show', ['post' => $post, 'comments' => $comments]);
    }

    public function delete(int $id): RedirectResponse
    {
        $post = Post::find($id);

        if ($post === null) {
            return abort(404);
        }

        if (!Gate::allows('delete-post', $post)) {
            return abort(403);
        }

        $deleted = Post::destroy($id);

        return to_route('index');
    }

    public function edit_form(int $id): View
    {
        $post = Post::with('categories')->find($id);

        if ($post == null) {
            return http_response_code(404);
        }

        $categories = Category::all();

        return view('post.edit', ['post' => $post, 'categories' => $categories]);
    }

    public function edit(int $id, Request $request): RedirectResponse
    {
        $post = Post::find($id);

        if ($post === null) {
            return abort(404);
        }

        if (!Gate::allows('update-post', $post)) {
            return abort(403);
        }

        $credentials = $request->validate([
            'title' => ['required'],
            'description' => ['required'],
            'categories' => ['required'],
        ]);

        $post->title = $credentials['title'];
        $post->description = $request['description'];

        $post->save();

        $post->categories()->sync($credentials['categories']);

        return to_route('post.show', $post->id);
    }

    public function create_form(): View|RedirectResponse
    {
        if (!Auth::check()) {
            return to_route('account.login');
        }

        $categories = Category::all();

        return view('post.create', ['categories' => $categories]);
    }

    public function create(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'title' => ['required'],
            'description' => ['required'],
            'categories' => ['required'],
        ]);

        DB::beginTransaction();

        $post = new Post();

        $post->title = $credentials['title'];
        $post->description = $credentials['description'];
        $post->user_id = Auth::id();

        $post->save();

        foreach($credentials["categories"] as $category) {
            $post->categories()->attach($category);
        }

        DB::commit();

        return to_route('post.show', $post->id);
    }
}
