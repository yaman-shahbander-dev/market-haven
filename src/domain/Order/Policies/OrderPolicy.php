<?php

namespace Domain\Order\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Domain\Client\Enums\PermissionEnum;
use Domain\Client\Models\User;
use Domain\Order\Models\Order;

class OrderPolicy
{
    use HandlesAuthorization;

    public function create(User $user): bool
    {
        return $user->can(PermissionEnum::ORDER_CREATE->value);
    }

    public function confirm(User $user): bool
    {
        return $user->can(PermissionEnum::ORDER_CONFIRM->value);
    }
}
