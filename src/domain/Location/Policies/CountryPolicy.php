<?php

namespace Domain\Location\Policies;

use Domain\Client\Enums\PermissionEnum;
use Domain\Client\Models\User;
use Domain\Location\Models\Country;
use Illuminate\Auth\Access\HandlesAuthorization;

class CountryPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Country $country): bool
    {
        return $user->can(PermissionEnum::COUNTRY_VIEW_ANY->value);
    }
}
