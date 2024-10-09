<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ForumController extends Controller
{
    public function show(): View
    {
        $posts = Post::with('user')->orderBy('created_at')->paginate();

        return view('forum.index', ['posts' => $posts]);
    }
}
