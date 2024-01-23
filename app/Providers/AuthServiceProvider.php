<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        //
    ];


    public function boot()
    {
        $this->registerPolicies();

        Gate::define('access-dashboard', function ($user) {
            return $user->role === 1; 
        });
    }
}
