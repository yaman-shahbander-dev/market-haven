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
}
