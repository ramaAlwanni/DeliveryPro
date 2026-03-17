<?php

namespace App\Providers;

use App\Models\User;
use app\Repositories\Interfaces\ProductRepositoryInterface;
use app\Repositories\Interfaces\StoresRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use app\Repositories\ProductRepository;
use app\Repositories\StoresRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class , UserRepository::class);
        $this->app->bind(StoresRepositoryInterface::class , StoresRepository::class);
        $this->app->bind(ProductRepositoryInterface::class , ProductRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::before(function (User $user, string $permission) {
            // 1. Universal Super User Check
            if ($user->hasRole('Super Admin')) {
                return true;
            }

            // // 2. Standard RBAC Check
            // return $user->hasPermission($permission);
        });

    }
}
