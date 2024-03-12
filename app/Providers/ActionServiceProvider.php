<?php

namespace App\Providers;


use App\Services\Contracts\User\UserServiceInterface;
use App\Services\User\UserService;
use Illuminate\Support\ServiceProvider;


class ActionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $bindings = [
            UserServiceInterface::class => UserService::class
        ];

        foreach ($bindings as $abstract => $concrete) {
            $this->app->bind($abstract, $concrete);
        }
    }
}