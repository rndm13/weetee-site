<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use App\Models\UserReport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;

class ReportController extends Controller
{
    public function create_form($id): View {
        $user = User::find($id);

        if ($user === null) {
            return abort(404);
        }

        if (!Gate::allows('report-account', $user)) {
            return to_route('account.login');
        }

        return view('account.report', ['user' => $user]);
    }

    public function create($id, Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'reason' => ['required'],
        ]);

        $user = User::find($id);

        if ($user === null) {
            return abort(404);
        }

        if (!Gate::allows('report-account', $user)) {
            return to_route('account.login');
        }

        $report = new UserReport();

        $report->from_user_id = Auth::id();
        $report->on_user_id = $id;
        $report->reason = $credentials["reason"];

        $report->save();

        return to_route('index');
    }
}
