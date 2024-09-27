<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PostController extends Controller
{
    public function show(int $id): View
    {
        $post = Post::with(['comments' => function($comments) {
            return $comments->orderBy('created_at')->paginate();
        }])->find($id);

        if ($post == null) {
            return http_response_code(404);
        }

        return view('post.show', ['post' => $post]);
    }

    public function delete(int $id): RedirectResponse
    {
        $deleted = Post::destroy($id);

        // TODO: Auth for post deletion

        return to_route('index');
    }

    public function edit_form(): View
    {
        return view('post.edit');
    }

    public function edit(int $id, Request $request): RedirectResponse
    {
        $post = Post::find($id);

        // TODO: Auth for post edit
        // TODO: Validate inputs

        if ($post == null) {
            return to_route('index', status: 404);
        }

        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->save();

        return to_route('post.show', $post->id);
    }

    public function create_form(): View|RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('account.login');
        }
        return view('post.create');
    }

    public function create(Request $request): RedirectResponse
    {
        $post = new Post();

        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->user_id = Auth::id();
        $post->save();

        return to_route('post.show', $post->id);
    }
}
