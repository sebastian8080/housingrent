<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
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

        // Define el gate 'is-admin'
        Gate::define('is-admin', function (User $user) {
            return $user->role_id === 1; // Asume que el rol_id 1 corresponde a 'Admin'
        });

        // Define el gate 'is-asesor'
        Gate::define('is-asesor', function (User $user) {
            return $user->role_id === 2; // Asume que el rol_id 3 corresponde a 'Asesor'
        });
        Gate::define('have_permissions', function (User $user) {
            return in_array($user->role_id, [1, 2]); // Admin y Asesor
        });
    }
}
