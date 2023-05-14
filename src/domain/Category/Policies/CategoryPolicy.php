<?php

namespace Domain\Category\Policies;

use Domain\Category\Models\Category;
use Domain\Client\Enums\PermissionEnum;
use Illuminate\Auth\Access\HandlesAuthorization;
use Domain\Client\Models\User;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Category $category): bool
    {
        return $user->can(PermissionEnum::CATEGORY_VIEW_ANY->value);
    }

    public function create(User $user): bool
    {
        return $user->can(PermissionEnum::CATEGORY_CREATE->value);
    }

    public function update(User $user, Category $category): bool
    {
        return $user->can(PermissionEnum::CATEGORY_UPDATE->value);
    }

    public function delete(User $user, Category $category): bool
    {
        return $user->can(PermissionEnum::CATEGORY_DELETE->value);
    }
}
