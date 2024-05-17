<?php

namespace App\Providers;

use Illuminate\Database\Schema\Builder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Blade;

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
        Schema::defaultStringLength(191);

        Blade::if('medis', function () {
            return auth()->user()->hasRole('medis');
        });

        Blade::if('admin', function () {
            return auth()->user()->hasRole('admin');
        });

        Blade::if('pasien', function () {
            return auth()->user()->hasRole('pasien');
        });
    }
}
