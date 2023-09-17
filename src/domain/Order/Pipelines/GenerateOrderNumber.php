<?php

namespace Domain\Order\Pipelines;

use Domain\Order\DataTransferObjects\OrderCartProductsData;
use Domain\Order\Models\Order;

/**
 * @param OrderCartProductsData $data
 */

class GenerateOrderNumber
{
    public function handle(OrderCartProductsData $data, \Closure $next)
    {
        $data->orderData->no = app(Order::class)->setSerialNumber();

        return $next($data);
    }
}
