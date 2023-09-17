<?php

namespace Domain\Cart\Policies;
use Domain\Cart\Models\Cart;
use Domain\Client\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Domain\Client\Enums\PermissionEnum;

class CartPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Cart $cart): bool
    {
        return $user->can(PermissionEnum::CART_VIEW_ANY->value);
    }

    public function create(User $user, Cart $cart): bool
    {
        return $user->can(PermissionEnum::CART_CREATE->value);
    }

    public function delete(User $user, Cart $cart): bool
    {
        return ($user->can(PermissionEnum::CART_DELETE->value) && $cart->user_id === $user->id);
    }

    public function add(User $user, Cart $cart): bool
    {
        return ($user->can(PermissionEnum::CART_ADD->value) && $cart->user_id === $user->id);
    }

    public function remove(User $user, Cart $cart): bool
    {
        return ($user->can(PermissionEnum::CART_REMOVE->value) && $cart->user_id === $user->id);
    }
}
