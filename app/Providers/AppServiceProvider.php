<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\FilmapikApiService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Mendaftarkan FilmapikApiService
        $this->app->singleton(FilmapikApiService::class, function ($app) {
            return new FilmapikApiService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
