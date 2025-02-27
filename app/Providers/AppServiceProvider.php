<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use App\Http\Resources\MenuTopResource;
use App\Http\Resources\MenuLeftResource;

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
        MenuTopResource::withoutWrapping();
        MenuLeftResource::withoutWrapping();
        Vite::prefetch(concurrency: 3);
    }
}
