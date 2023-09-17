<?php

namespace Domain\Client\QueryBuilders;

use Domain\Client\Enums\UserTypes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;

class UserQueryBuilder extends Builder
{
    public function type(): Attribute
    {
        return Attribute::make(
            set: fn($value) => strtolower($value)
        );
    }

    public function admin(): self
    {
        return $this->where('type', '=', UserTypes::ADMIN->value);
    }
}
