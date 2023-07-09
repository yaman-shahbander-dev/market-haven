<?php

namespace Domain\Cart\DataTransferObjects;

use Carbon\Carbon;
use Domain\Client\DataTransferObjects\UserData;
use Domain\Product\DataTransferObjects\ProductData;
use Shared\Helpers\BaseData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class CartData extends BaseData
{
    public function __construct(
        public ?string $id,
        public string $userId,
        public string $quantity,
        public string $price,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
        public ?UserData $user,
        #[DataCollectionOf(ProductData::class)]
        public ?DataCollection $productsWithDetails
    ) {
    }
}
