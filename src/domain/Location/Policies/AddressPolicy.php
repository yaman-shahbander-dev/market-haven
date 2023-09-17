<?php

namespace Domain\Location\Policies;

use Domain\Client\Enums\PermissionEnum;
use Domain\Client\Models\User;
use Domain\Location\Models\Address;
use Illuminate\Auth\Access\HandlesAuthorization;

class AddressPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Address $address): bool
    {
        return $user->can(PermissionEnum::ADDRESS_VIEW_ANY->value);
    }

    public function create(User $user, Address $address): bool
    {
        return $user->can(PermissionEnum::ADDRESS_CREATE->value);
    }
}
