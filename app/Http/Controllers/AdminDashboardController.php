<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

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

    public function posts(): View {
        return view('admin.posts');
    }

    public function translations(): View {
        return view('admin.translations');
    }
}
