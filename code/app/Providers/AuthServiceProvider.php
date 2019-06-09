<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Guard for checking whether requester owns a model
        Gate::define('model-owner', function ($user, $owner) {
            return $user->id === $owner->id;
        });

        // Guard for checking whether requester has a certain roles
        Gate::define('user-role', function ($user, $role) {
            return $user->hasRole($role);
        });
    }
}
