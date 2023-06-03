<?php

namespace Domain\Brand\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Domain\Client\Enums\PermissionEnum;
use Domain\Brand\Models\Brand;
use Domain\Client\Models\User;

class BrandPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Brand $brand): bool
    {
        return $user->can(PermissionEnum::BRAND_VIEW_ANY->value);
    }

    public function create(User $user): bool
    {
        return $user->can(PermissionEnum::BRAND_CREATE->value);
    }

    public function update(User $user, Brand $brand): bool
    {
        return $user->can(PermissionEnum::BRAND_UPDATE->value);
    }

    public function delete(User $user, Brand $brand): bool
    {
        return $user->can(PermissionEnum::BRAND_DELETE->value);
    }
}
