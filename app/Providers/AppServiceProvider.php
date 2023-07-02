<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;
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
        Facades\View::composer('*', function (View $view) {
            $view->with('currentUser', Auth::user());
        });
        if ($this->app->isLocal()) {
        } else {
            $this->app['request']->server->set('HTTPS', true);
        }
        Schema::defaultStringLength(191);
    }
}
