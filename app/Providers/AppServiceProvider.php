<?php

namespace App\Providers;

use App\Blade\SvgDirective;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
		session(['locale' => App::getLocale()]);
        SvgDirective::register();
		Paginator::useBootstrap();

        $this->app['validator']->extend('password_check', function ($attribute, $value, $parameters, $validator) {
            return Hash::check($value, $parameters[0]);
        });

        if (!isset($_COOKIE['cart_id'])) {
            setcookie('cart_id', uniqid());
        }
    }
}
