<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocaleController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($locale)
    {
		App::setLocale($locale);
		session(['locale' => $locale]);
        if (auth()->user()) {
            auth()->user()->update(['lang' => $locale]);
        }
		return redirect()->back();
    }
}
