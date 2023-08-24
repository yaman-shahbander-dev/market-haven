<?php

namespace Domain\Location\DataTransferObjects;

use Carbon\Carbon;
use Shared\Helpers\BaseData;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class CityData extends BaseData
{
    public function __construct(
        public int $id,
        public int $countryId,
        public string $name,
        public ?string $fullName,
        public ?string $code,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
    ) {
    }
}
