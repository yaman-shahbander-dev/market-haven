<?php

namespace Domain\Favorite\DataTransferObjects;

use Shared\Helpers\BaseData;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Carbon\Carbon;

#[MapName(SnakeCaseMapper::class)]
class FavoriteData extends BaseData
{
    public function __construct(
        public ?string $id,
        public ?string $userId,
        public ?string $favorableType,
        public ?string $favorableId,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
    ) {
    }
}
