<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;
use App\Models\UserReport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use App\Mail\UserReportReply;

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

    public function details(int $id): View {
        $report = UserReport::find($id);

        if ($report === null) {
            abort(404);
        }

        return view('admin.report_details', ['report' => $report]);
    }

    public function resolve(int $id): RedirectResponse {
        $report = UserReport::find($id);

        if ($report === null) {
            abort(404);
        }

        $report->status = 'resolved';
        $report->save();

        return back();
    }

    public function reply(int $id, Request $request): RedirectResponse {
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
}
