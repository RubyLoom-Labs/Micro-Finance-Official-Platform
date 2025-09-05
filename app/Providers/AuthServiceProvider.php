<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
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

        Gate::define('create-user-accounts', fn($user) => $user->user_role->user_accounts_creation == 1);
        Gate::define('dashboard', fn($user) => $user->user_role->dashboard == 1);
        Gate::define('branch_creation', fn($user) => $user->user_role->branch_creation == 1);
        Gate::define('create-user-roles', fn($user) => $user->user_role->user_role_creation == 1);
        Gate::define('centers-view', function ($user) {
            return in_array($user->user_role->centers, [1, 2, 3]);
        });
        Gate::define('centers-edit', function ($user) {
            return in_array($user->user_role->centers, [2, 3]);
        });
        Gate::define('centers-delete', fn($user) => $user->user_role->centers == 3);
        Gate::define('members-view', function ($user) {
            return in_array($user->user_role->members, [1, 2, 3]);
        });
        Gate::define('members-edit', function ($user) {
            return in_array($user->user_role->members, [2, 3]);
        });
        Gate::define('members-delete', fn($user) => $user->user_role->members == 3);
        Gate::define('user-logs', fn($user) => $user->user_role->user_logs == 1);
        Gate::define('loans', fn($user) => $user->user_role->loans == 1);
        Gate::define('income', fn($user) => $user->user_role->income == 1);
        Gate::define('reports', fn($user) => $user->user_role->reports == 1);
        Gate::define('payments', fn($user) => $user->user_role->payments == 1);
        Gate::define('groups-view', function ($user) {
            return in_array($user->user_role->groups, [1, 2, 3]);
        });
        Gate::define('groups-edit', function ($user) {
            return in_array($user->user_role->groups, [2, 3]);
        });
        Gate::define('groups-delete', fn($user) => $user->user_role->groups == 3);
    }
}
