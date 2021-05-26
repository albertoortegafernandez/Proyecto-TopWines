<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Wine;
use Illuminate\Auth\Access\HandlesAuthorization;

class WinePolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    public function view(User $user, Wine $wine)
    {
        return true;
    }

    public function create(User $user)
    {
        return $user->isAdmin();
    }

    public function update(User $user, Wine $wine)
    {
        return $user->isAdmin();
    }

    public function delete(User $user)
    {
        return $user->isAdmin();
    }


    public function restore(User $user, Wine $wine)
    {
        //
    }

    public function forceDelete(User $user, Wine $wine)
    {
        //
    }
}
