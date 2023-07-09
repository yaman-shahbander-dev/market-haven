<?php

namespace App\Admin\v1\Http\Cart\Controllers;

use App\Admin\v1\Http\Cart\Resources\CartResource;
use App\Http\Controllers\Controller;
use Domain\Cart\Actions\Admin\GetCartsAction;
use Domain\Cart\Actions\Admin\ShowCartAction;
use Domain\Cart\Models\Cart;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
    public function index(): JsonResponse
    {
        $this->authorize('view', app(Cart::class));

        $carts = GetCartsAction::run();

        return CartResource::paginatedCollection($carts);
    }

    public function show(Cart $cart): JsonResponse
    {
        $this->authorize('view', app(Cart::class));

        $cart = ShowCartAction::run($cart->id);

        return $cart
            ? $this->okResponse(CartResource::make($cart))
            : $this->failedResponse();
    }
}
