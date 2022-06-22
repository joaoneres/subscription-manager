<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Product $product)
    {
        return true;
    }

    public function create(User $user)
    {
        return $user->is_admin;
    }

    public function edit(User $user, Product $product)
    {
        return $user->is_admin;
    }

    public function update(User $user, Product $product)
    {
        return $user->is_admin;
    }

    public function destroy(User $user, Product $product)
    {
        return $user->is_admin;
    }
}
