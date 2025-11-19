<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
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
        // Solo ejecutar el SET time_zone cuando el driver sea MySQL
        if (DB::getDriverName() === 'mysql') {
            DB::statement("SET time_zone = '-03:00'");
        }
    }
}
