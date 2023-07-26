<?php

namespace Domain\Order\DataTransferObjects;

use Carbon\Carbon;
use Domain\Cart\DataTransferObjects\CartProductData;
use Domain\Order\States\OrderState;
use Shared\Helpers\BaseData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class OrderData extends BaseData
{
    public function __construct(
        public ?string $id,
        public ?int $no,
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $paymentGateway,
        public ?float $price,
        public ?OrderState $state,  //public ?OrderState $state;
        public ?string $cartId,
        public string $userId,
        #[DataCollectionOf(CartProductData::class)]
        public ?DataCollection $cartProducts,
        public ?Carbon $expiredAt,
        public ?Carbon $createdAt,
        public ?Carbon $updatedAt,
        public ?Carbon $deletedAt,
    ) {
    }
}
