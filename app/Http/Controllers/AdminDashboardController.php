<?php

namespace App\Http\Controllers;

use App\Models\Category;
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

        Log::debug($inputs);

        $category = new Category();

        Log::debug($inputs);

        if (array_key_exists("id", $inputs)) {
            $category = Category::find($inputs["id"]);

            if ($category === null) {
                abort(404);
            }
        }

        $category->title = $inputs["title"];

        $category->save();

        Log::debug($category);

        return to_route('admin.categories');
    }

    public function posts(): View {
        return view('admin.posts');
    }

    public function translations(): View {
        return view('admin.translations');
    }
}
