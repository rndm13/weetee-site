<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class TranslationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->hasCookie('locale')) {
            $locale = Crypt::decryptString($request->cookie('locale'));
            $end = strpos($locale, '|');

            $locale = substr($locale, $end + 1);
            Log::debug($locale);
            app()->setLocale($locale);
        }

        return $next($request);
    }
}
