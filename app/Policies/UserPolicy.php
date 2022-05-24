<?php

namespace App\Policies;

use App\Models\User;
use Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function view(User $authenticatedUser, User $user)
    {
        if($user->role_id == 1)
            return true;
        else
            return $user->id==$authenticatedUser->id;
    }

    public function update(User $authenticatedUser, User $user)
    {
        if($user->role_id == 1)
            return true;
        else
            return $user->id==$authenticatedUser->id;
    }

    public function delete(User $user)
    {
        if($user->role_id == 1)
            return true;
        else
            return $user->id==$authenticatedUser->id;
    }
}
