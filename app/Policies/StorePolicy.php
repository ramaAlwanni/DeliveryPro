<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StorePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('view-store');
    }

    // public function search(User $user): bool
    // {
    //     return $user->can('search-product');
    // }

    // public function create(User $user, Store $store): bool
    // {
    //     if ($user->can('create-product')) {
    //         return $user->id == $store->user_id;
    //     }
    //     return false;
    // }

    // public function update(User $user, Store $store): bool
    // {
    //     if ($user->can('edit-product')) {
    //         return $user->id == $store->user_id;
    //     }
    //     return false;
    // }

    // public function delete(User $user, Store $store): bool
    // {
    //     if ($user->can('delete-product')) {
    //         return $user->id == $store->user_id;
    //     }
    //     return false;
    // }
}
