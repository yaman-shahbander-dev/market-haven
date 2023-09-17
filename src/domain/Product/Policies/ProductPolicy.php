<?php

namespace Domain\Product\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Domain\Product\Models\Product;
use Domain\Client\Models\User;
use Domain\Client\Enums\PermissionEnum;

class ProductPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Product $product): bool
    {
        return $user->can(PermissionEnum::PRODUCT_VIEW_ANY->value);
    }

    public function create(User $user): bool
    {
        return $user->can(PermissionEnum::PRODUCT_CREATE->value);
    }

    public function update(User $user, Product $product): bool
    {
        return $user->can(PermissionEnum::PRODUCT_UPDATE->value);
    }

    public function delete(User $user, Product $product): bool
    {
        return $user->can(PermissionEnum::PRODUCT_DELETE->value);
    }
}
