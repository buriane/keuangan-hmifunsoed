<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\User;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('bendahara', function (User $user) {
            return $user->username === 'bendahara';
        });
        Gate::define('kreus', function (User $user) {
            if (auth()->check() and auth()->user()->username === 'kreus') {
                return $user->username === 'kreus';
            } elseif (auth()->check() and auth()->user()->username === 'bendahara') {
                return $user->username === 'bendahara';
            }
        });
    }
}
