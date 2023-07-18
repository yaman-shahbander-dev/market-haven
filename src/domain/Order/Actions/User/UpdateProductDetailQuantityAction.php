<?php

namespace Domain\Order\Actions\User;

use Domain\Cart\DataTransferObjects\CartProductData;
use Domain\Cart\Models\CartProduct;
use Domain\Product\Models\ProductDetail;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateProductDetailQuantityAction
{
    use AsAction;

    public function __construct(
        protected ProductDetail $productDetail
    ) {
    }

    public function handle(array $cartProduct, CartProductData $cartProductData): bool
    {
        return $this
            ->productDetail
            ->query()
            ->where('product_id', $cartProductData->productId)
            ->update([
                'quantity' => $cartProductData->product->productDetail->quantity - $cartProduct['quantity']
            ]);
    }
}
