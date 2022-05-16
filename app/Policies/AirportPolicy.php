<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Airport;
use Illuminate\Auth\Access\HandlesAuthorization;

class AirportPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->role_id == 1;
    }

    public function update(User $user, Airport $a)
    {
        return $user->role_id == 1;
    }

    public function delete(User $user, Airport $a)
    {
        return $user->role_id == 1;
    }

    public function restore(User $user, Airport $a)
    {
        return $user->role_id == 1;
    }

    public function forceDelete(User $user, Airport $a)
    {
        return $user->role_id == 1;
    }
}
