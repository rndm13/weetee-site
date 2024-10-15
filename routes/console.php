<?php

use Illuminate\Support\Carbon;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountConfirmation;

Artisan::command('new-command', function () {
})->purpose('Future command');

Schedule::call(function () {
    DB::table('users')->where('created_date', '<=', Carbon::now()->subDays(2)->toDateTimeString())->whereAnd('email_verified_at', null)->delete();
})->daily();
