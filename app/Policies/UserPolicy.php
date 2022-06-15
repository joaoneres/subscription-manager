<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function index(User $user)
    {
        return (bool) $user->is_admin;
    }

    public function show(User $user)
    {
        return (bool) $user->is_admin;
    }

    public function edit(User $user)
    {
        return (bool) $user->is_admin;
    }

    public function update(User $user)
    {
        return (bool) $user->is_admin;
    }

    public function destroy(User $user)
    {
        return (bool) $user->is_admin;
    }
}
