<?php

namespace Domain\Location\DataTransferObjects;

use Carbon\Carbon;
use Domain\Order\DataTransferObjects\OrderData;
use Shared\Helpers\BaseData;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class AddressData extends BaseData
{
    public function __construct(
        public string $id,
        public int $cityId,
        public string $orderId,
        public string $address,
        public string $postalCode,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
        public ?CityData $city,
        public ?OrderData $order,
    ) {
    }
}
