<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CommentController extends Controller
{
    public function delete(int $id): RedirectResponse
    {
        $deleted = Comment::destroy($id);

        // TODO: Auth for post deletion

        return back();
    }

    public function edit(int $id, Request $request): RedirectResponse
    {
        $comment = Comment::find($id);

        // TODO: Auth for comment edit
        // TODO: Validate inputs

        if ($comment == null) {
            return to_route('index', status: 404);
        }

        $comment->description = $request->input('description');
        $comment->save();

        return back();
    }

    public function create(int $post_id, Request $request): RedirectResponse
    {
        $comment = new Comment();

        $comment->description = $request->input('description');
        $comment->post_id = $post_id;
        $comment->user_id = Auth::id();

        $comment->save();

        return back();
    }
}
