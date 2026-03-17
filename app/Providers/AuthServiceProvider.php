<?php

namespace App\Providers;

use App\Models\Store;
use App\Models\User;
use App\Policies\StorePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{

    // /**
    //  * The model to policy mappings for the application.
    //  *
    //  * @var array<class-string, class-string>
    //  */

    protected $policies = [
        Store::class => StorePolicy::class
    ];


    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
