<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class CommentController extends Controller
{
    public function delete(int $id): RedirectResponse
    {
        $comment = Comment::find($id);

        if ($comment === null) {
            return abort(404);
        }

        if (!Gate::allows('delete-comment', $comment)) {
            return abort(403);
        }

        $deleted = Comment::destroy($id);

        return back();
    }

    public function edit(int $id, Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'description' => ['required'],
        ]);

        $comment = Comment::find($id);

        if ($comment === null) {
            return abort(404);
        }

        if (!Gate::allows('update-comment', $comment)) {
            return abort(403);
        }

        if ($comment == null) {
            return to_route('index', status: 404);
        }

        $comment->description = $credentials['description'];
        $comment->save();

        return back();
    }

    public function create(int $post_id, Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'description' => ['required'],
        ]);

        $comment = new Comment();

        $comment->description = $credentials['description'];
        $comment->post_id = $post_id;
        $comment->user_id = Auth::id();

        $comment->save();

        return back();
    }
}
