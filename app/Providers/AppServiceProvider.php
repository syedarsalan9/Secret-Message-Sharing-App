<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        $this->app->bind(
            \App\Contracts\MessageServiceInterface::class,
            \App\Services\MessageService::class
        );
        $this->app->bind(
            \App\Contracts\MessageRepositoryInterface::class,
            \App\Repositories\MessageRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
