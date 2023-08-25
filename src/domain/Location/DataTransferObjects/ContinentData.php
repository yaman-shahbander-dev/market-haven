<?php

namespace Domain\Location\DataTransferObjects;

use Carbon\Carbon;
use Shared\Helpers\BaseData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class ContinentData extends BaseData
{
    public function __construct(
        public ?int $id,
        public string $name,
        public string $code,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
        #[DataCollectionOf(CountryData::class)]
        public ?DataCollection $countries,
    ) {
    }
}
