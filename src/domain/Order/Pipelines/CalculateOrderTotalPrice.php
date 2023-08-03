<?php

namespace Domain\Order\Pipelines;

use Domain\Order\DataTransferObjects\OrderCartProductsData;

/**
 * @param OrderCartProductsData $data
*/

class CalculateOrderTotalPrice
{
    public function handle(OrderCartProductsData $data, \Closure $next)
    {
        $data->orderData->price = collect($data->cartProducts)->map(function ($cartProduct) use ($data) {
            $quantity = collect($data->orderData->cartProducts)->firstWhere('id', $cartProduct['id'])['quantity'];
            $productDetailPrice = $cartProduct['product']['product_detail']['price'];
            return $productDetailPrice * $quantity;
        })->sum();

        return $next($data);
    }
}
