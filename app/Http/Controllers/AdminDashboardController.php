<?php

namespace App\Http\Controllers;

use App\Models\UserReport;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserReportReply;

class AdminDashboardController extends Controller
{
    public function dashboard(): View {
        return view('admin.index');
    }

    public function users(): View {
        $users = User::paginate();

        return view('admin.users', ['users' => $users]);
    }

    public function documentation(): View {
        return view('admin.documentation');
    }

    public function reports(): View {
        $reports = UserReport::paginate();

        return view('admin.reports', ['reports' => $reports]);
    }

    public function report_details(int $id): View {
        $report = UserReport::find($id);

        if ($report === null) {
            abort(404);
        }

        return view('admin.report_details', ['report' => $report]);
    }

    public function report_resolve(int $id): RedirectResponse {
        $report = UserReport::find($id);

        if ($report === null) {
            abort(404);
        }

        $report->status = 'resolved';
        $report->save();

        return back();
    }

    public function report_reply(int $id, Request $request): RedirectResponse {
        $inputs = $request->validate([
            'reply' => ['required']
        ]);

        $report = UserReport::with('from_user')->find($id);

        if ($report === null) {
            abort(404);
        }

        $to = $report->from_user->email;

        Mail::to($to)->send(new UserReportReply($report, $inputs['reply']));

        return back();
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
