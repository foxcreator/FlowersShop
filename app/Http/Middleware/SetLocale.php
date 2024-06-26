<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('locale')) {
            session()->put('locale', 'uk');
        }
        if (auth()->user() && auth()->user()->lang) {
            App::setLocale(auth()->user()->lang);
            session()->put('locale', App::getLocale());
        } else {
            App::setLocale(session('locale'));
        }

        return $next($request);
    }
}
