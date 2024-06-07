<?php

namespace App\Providers;

use App\Enum\RoleEnum;
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

        Blade::if('admin', function () {
            return auth()->user()->hasRole(RoleEnum::ADMIN->name());
        });

        Blade::if('medis', function () {
            return auth()->user()->hasRole(RoleEnum::MEDIS->name());
        });

        Blade::if('pasien', function () {
            return auth()->user()->hasRole(RoleEnum::PASIEN->name());
        });
    }
}
