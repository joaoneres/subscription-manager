<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilePolicy
{
    use HandlesAuthorization;

    public function updateAvatar(User $user, User $user_to_process)
    {
        return $user->id === $user_to_process->id;
    }

    public function simpleData(User $user, User $user_to_process)
    {
        return $user->id === $user_to_process->id;
    }
}
