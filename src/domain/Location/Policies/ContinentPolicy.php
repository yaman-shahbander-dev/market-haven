<?php

namespace Domain\Location\Policies;

use Domain\Client\Enums\PermissionEnum;
use Domain\Client\Models\User;
use Domain\Location\Models\Continent;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContinentPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Continent $continent): bool
    {
        return $user->can(PermissionEnum::CONTINENT_VIEW_ANY->value);
    }
}
