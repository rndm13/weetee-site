<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;

class AdminDashboardController extends Controller
{
    public function dashboard(): View {
        return view('admin.index');
    }

    public function users(): View {
        return view('admin.users');
    }

    public function documentation(): View {
        return view('admin.documentation');
    }

    public function reports(): View {
        return view('admin.reports');
    }

    public function categories(): View {
        $categories = Category::paginate();

        return view('admin.categories', ['categories' => $categories]);
    }

    public function category_save(Request $request): RedirectResponse {
        $inputs = $request->validate([
            "id" => ["sometimes"], // For edits
            "title" => ["required"],
        ]);

        $category = new Category();

        if (array_key_exists("id", $inputs)) {
            $category = Category::find($inputs["id"]);

            if ($category === null) {
                abort(404);
            }
        }

        $category->title = $inputs["title"];

        $category->save();

        return to_route('admin.categories');
    }

    public function category_delete(int $id, Request $request): RedirectResponse {
        Category::destroy($id);

        return to_route('admin.categories');
    }

    public function posts(): View {
        $posts = Post::paginate();

        return view('admin.posts', ['posts' => $posts]);
    }

    public function translations(): View {
        return view('admin.translations');
    }
}
