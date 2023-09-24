<?php

namespace Domain\Review\Policies;
use Domain\Client\Enums\PermissionEnum;
use Domain\Client\Models\User;
use Domain\Review\Models\Review;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReviewPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Review $review): bool
    {
        return $user->can(PermissionEnum::REVIEW_VIEW_ANY->value);
    }

    public function create(User $user): bool
    {
        return $user->can(PermissionEnum::REVIEW_CREATE->value);
    }

    public function delete(User $user, Review $review): bool
    {
        return $user->can(PermissionEnum::REVIEW_DELETE->value);
    }

    public function approve(User $user, Review $review): bool
    {
        return $user->can(PermissionEnum::REVIEW_APPROVE->value);
    }
}
