<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\FilmapikApiService;

class FilmapikApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Mendaftarkan FilmapikApiService sebagai singleton
        $this->app->singleton(FilmapikApiService::class, function ($app) {
            return new FilmapikApiService();
        });

        // Mendaftarkan service dengan alias
        $this->app->bind('filmapik.api', function ($app) {
            return $app->make(FilmapikApiService::class);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}