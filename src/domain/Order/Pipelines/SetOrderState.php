<?php

namespace Domain\Order\Pipelines;

use Domain\Order\DataTransferObjects\OrderCartProductsData;

/**
 * @param OrderCartProductsData $data
 */

class SetOrderState
{
    public function handle(OrderCartProductsData $data, \Closure $next)
    {
        $data->orderData->state = 'pending'; // to be changed to use the state design pattern

        return $next($data);
    }
}
