<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ForumController extends Controller
{
    public function show(Request $request): View
    {
        $category = (int)$request->category;
        $search = $request->search ?? "";

        $posts = Post::with('user')->orderBy('created_at', 'desc');

        if ($category) {
            $posts = $posts->whereHas('categories', function (Builder $q) use ($category) {
                $q->where('categories.id', $category);
            });
        }

        $posts = $posts->where(function (Builder $q) use ($search) {
            $q->where('title', 'like', "%$search%")->orWhere('description', 'like', "%$search%");
        });

        $posts = $posts->paginate();

        $categories = Category::all();

        $filter = ["search" => $search, "category" => $category];

        return view('forum.index', ['posts' => $posts, 'categories' => $categories, 'filter' => $filter]);
    }
}
