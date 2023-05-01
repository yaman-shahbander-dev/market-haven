<?php

namespace Domain\Client\DataTransferObjects;

use Domain\Client\Enums\UserScopes;
use Domain\Client\Enums\UserTypes;
use Shared\Helpers\BaseData;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class AuthData extends BaseData
{
    public function __construct(
        public string $email,
        public string $password,
        public ?string $name,
        public ?string $firstName,
        public ?string $lastName,
        public ?string $gender,
        public ?string $scope = UserScopes::USER->value,
        public ?string $type = UserTypes::USER->value,
    ) {
    }
}
