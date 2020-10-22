<?php

namespace App\Providers;

use App\Models\LocomotiveApplication;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('create-app', function (User $user) {
            return $user->isCustomer() || $user->isSA() || $user->isAdmin();
        });

        Gate::define('edit-app', function (User $user, LocomotiveApplication $application) {
            return $user->id === $application->user_id || $user->isSA() || $user->isAdmin();
        });
    }
}
