<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    public function view(User $user): bool
    {
        return $user->can('view-product');
    }

    public function search(User $user): bool
    {
        return $user->can('search-product');
    }

    public function create(User $user , Store $store): bool
    {
        if($user->can('create-product')){
            return $user->id == $store->user_id;
        }
        return false;
    }

    public function update(User $user , Store $store): bool
    {
        if ($user->can('edit-product')) {
            return $user->id == $store->user_id;
        }
        return false;
    }

    public function delete(User $user, Store $store): bool
    {
        if ($user->can('delete-product')) {
            return $user->id == $store->user_id;
        }
        return false;
    }
}
