<?php

namespace Domain\Location\Policies;

use Domain\Client\Enums\PermissionEnum;
use Domain\Client\Models\User;
use Domain\Location\Models\City;
use Illuminate\Auth\Access\HandlesAuthorization;

class CityPolicy
{
    use HandlesAuthorization;

    public function view(User $user, City $city): bool
    {
        return $user->can(PermissionEnum::CITY_VIEW_ANY->value);
    }
}
