<?php

namespace App\Policies;

use App\Models\User;
use Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->role_id == 1 || $user->id==Auth::user()->id;
    }

    public function update(User $user)
    {
        return $user->role_id == 1 || $user->id==Auth::user()->id;
    }

    public function delete(User $user)
    {
        return $user->role_id == 1 || $user->id==Auth::user()->id;
    }

    public function restore(User $user)
    {
        return true;
    }

    public function forceDelete(User $user)
    {
        return true;
    }
}
