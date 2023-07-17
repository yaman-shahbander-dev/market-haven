<?php

namespace Domain\Order\DataTransferObjects;

use Domain\Cart\DataTransferObjects\CartData;
use Domain\Cart\DataTransferObjects\CartProductData;
use Shared\Helpers\BaseData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class OrderCartProductsData extends BaseData
{
    public function __construct(
        public OrderData $orderData,
        #[DataCollectionOf(CartProductData::class)]
        public DataCollection $cartProducts,
        public CartData $cart,
    ) {
    }
}
