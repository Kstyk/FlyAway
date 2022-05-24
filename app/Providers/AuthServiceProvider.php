<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\TripPolicy;
use App\Policies\UserPolicy;
use App\Policies\FlightPolicy;
use App\Policies\CountryPolicy;
use App\Policies\AirportPolicy;
use App\Models\User;
use App\Models\Trip;
use App\Models\Flight;
use App\Models\Country;
use App\Models\Airport;
use Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Trip::class => TripPolicy::class,
        User::class => UserPolicy::class,
        Country::class => CountryPolicy::class,
        Flight::class => FlightPolicy::class,
        Airport::class => AirportPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('is-admin', function (User $user) {
            return $user->isAdmin();
        });

    }
}
