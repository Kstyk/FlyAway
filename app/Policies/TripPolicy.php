<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Trip;
use Illuminate\Auth\Access\HandlesAuthorization;

class TripPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Trip $trip)
    {
        return $user->role_id == 1;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Trip $trip)
    {
        return $user->role_id == 1;
    }

    public function delete(User $user, Country $country)
    {
        return true;
    }

    public function restore(User $user, Country $country)
    {
        return true;
    }

    public function forceDelete(User $user, Country $country)
    {
        return true;
    }
}
