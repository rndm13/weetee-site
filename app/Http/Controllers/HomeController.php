<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function show(): View
    {
        return view('index');
    }

    public function install(string $os)
    {
        $filename = 'weetee-'.$os.'.zip';
        $path = Storage::disk('public')->path($filename);

        if (!Storage::disk('public')->exists($filename)) {
            return abort(404);
        }

        return response()->file($path);
    }
}
