<?php

namespace Domain\Review\DataTransferObjects;

use Carbon\Carbon;
use Shared\Helpers\BaseData;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class ReviewData extends BaseData
{
    public function __construct(
        public ?string $id,
        public string $reviewableType,
        public string $reviewableId,
        public string $userId,
        public string $rating,
        public string $review,
        public ?Carbon $approvedAt,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
    ) {}
}
