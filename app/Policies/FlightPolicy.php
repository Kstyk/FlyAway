<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Flight;
use Illuminate\Auth\Access\HandlesAuthorization;

class FlightPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->role_id == 1;
    }

    public function update(User $user, Flight $f)
    {
        return $user->role_id == 1;
    }

    public function delete(User $user, Flight $f)
    {
        return $user->role_id == 1;
    }

    public function restore(User $user, Flight $f)
    {
        return $user->role_id == 1;
    }

    public function forceDelete(User $user, Flight $f)
    {
        return $user->role_id == 1;
    }
}
