<?php

namespace Domain\Order\Actions\User;

use Domain\Cart\DataTransferObjects\CartProductData;
use Domain\Order\DataTransferObjects\OrderCartProductsData;
use Domain\Order\DataTransferObjects\OrderData;
use Domain\Order\Pipelines\CalculateOrderTotalPrice;
use Domain\Order\Pipelines\GenerateOrderNumber;
use Domain\Order\Pipelines\SetOrderExpiredAt;
use Domain\Order\Pipelines\SetOrderState;
use Illuminate\Pipeline\Pipeline;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\LaravelData\DataCollection;

/**
 * @param OrderData $orderData
 * @param DataCollection<CartProductData> $cartProducts
 * @param OrderCartProductsData $data
 */

class FillOrderDataAction
{
    use AsAction;

    public function __construct(
    ) {
    }

    public function handle(OrderCartProductsData $data)
    {
        $result = app(Pipeline::class)
            ->send($data)
            ->through([
                CalculateOrderTotalPrice::class,
                GenerateOrderNumber::class,
                SetOrderState::class,
                SetOrderExpiredAt::class,
            ])
            ->then(function (OrderCartProductsData $data) {
                return OrderCreateAction::run($data);
            });

        return $result;
    }
}
