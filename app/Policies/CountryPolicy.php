<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Country;
use Illuminate\Auth\Access\HandlesAuthorization;

class CountryPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->role_id == 1;
    }

    public function update(User $user, Country $c)
    {
        return $user->role_id == 1;
    }

    public function delete(User $user, Country $c)
    {
        return $user->role_id == 1;
    }

    public function restore(User $user, Country $c)
    {
        return $user->role_id == 1;
    }

    public function forceDelete(User $user, Country $c)
    {
        return $user->role_id == 1;
    }
}
