<?php

namespace Domain\Order\Pipelines;

use Domain\Order\DataTransferObjects\OrderCartProductsData;

/**
 * @param OrderCartProductsData $data
 */

class SetOrderExpiredAt
{
    public function handle(OrderCartProductsData $data, \Closure $next)
    {
        $data->orderData->expiredAt = now()->addMinutes(config('app.default.order_expiry', 30));

        return $next($data);
    }
}
