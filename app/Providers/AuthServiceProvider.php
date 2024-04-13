<?php

namespace App\Providers;

use App\Models\Enums\Ability;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('login', function (?User $user) {
            if ($user?->isBanned()) {
                return Response::deny('Your account is suspended.');
            }

            return true;
        });

        Gate::before(function (User $user, string $ability) {
            $ability = Ability::tryFrom($ability);

            return $user->role?->abilities->contains($ability) ? true : null;
        });
    }
}
