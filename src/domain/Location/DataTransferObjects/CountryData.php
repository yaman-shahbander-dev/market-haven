<?php

namespace Domain\Location\DataTransferObjects;

use Carbon\Carbon;
use Shared\Helpers\BaseData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class CountryData extends BaseData
{
    public function __construct(
        public int $id,
        public int $continentId,
        public string $name,
        public ?string $fullName,
        public ?string $capital,
        public ?string $code,
        public ?string $codeAlpha3,
        public ?string $emoji,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
        #[DataCollectionOf(CityData::class)]
        public ?DataCollection $cities,
    ) {
    }
}
