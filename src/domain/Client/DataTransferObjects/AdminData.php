<?php

namespace Domain\Client\DataTransferObjects;

use Carbon\Carbon;
use Domain\Client\Enums\UserScopes;
use Domain\Client\Enums\UserTypes;
use Shared\Helpers\BaseData;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class AdminData extends BaseData
{
    public function __construct(
        public ?string $id,
        public string $name,
        public ?string $firstName,
        public ?string $lastName,
        public ?string $gender,
        public readonly ?string $scope = UserScopes::ADMIN->value,
        public readonly ?string $type = UserTypes::ADMIN->value,
        public ?string $password,
        public ?string $email,
        public ?Carbon $bannedAt,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
        public ?string $bearerToken,
    ) {
    }
}
