<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register any application services here.
        // You can bind interfaces to implementations, register singletons, etc.
        // For example:
        // $this->app->bind('SomeInterface', 'SomeImplementation');
        // Or if you have a service class:
        // $this->app->singleton(\App\Services\UserService::class, function ($app) {
        //     return new \App\Services\UserService();
        // });
        // --- IGNORE ---
        // $this->app->singleton('UserService', function ($app) {
        //     return new \App\Services\UserService();
        // });
        // --- IGNORE ---
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
