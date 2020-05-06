<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Users;
use App\Observers\UsersObserver;

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
        //

        Users::observe(UsersObserver::class);
    }
}
