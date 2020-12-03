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

        Gate::before(function (User $user) {
            if ($user->isSA() || $user->isAdmin()) {
                return true;
            }
        });

        Gate::define('create-app', function (User $user) {
            return $user->isCustomer();
        });

        Gate::define('edit-app', function (User $user, LocomotiveApplication $application) {
            return $application->user->is($user);
        });

        Gate::define('approve-nodn', function (User $user) {
            return $user->isNodn();
        });

        Gate::define('approve-nodt', function (User $user) {
            return $user->isNodt();
        });

        Gate::define(function (User $user) {
            return $user->isNodshp();
        }, 'approve-nodshp');

        Gate::define('sysadmin', function (User $user) {
            return $user->isSA() || $user->isAdmin();
        });
    }
}
