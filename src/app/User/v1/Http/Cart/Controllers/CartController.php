<?php

namespace App\User\v1\Http\Cart\Controllers;

use App\Http\Controllers\Controller;
use App\User\v1\Http\Cart\Requests\AddProductToCartRequest;
use App\User\v1\Http\Cart\Requests\CreateCartRequest;
use App\User\v1\Http\Cart\Requests\RemoveProductFromCartRequest;
use App\User\v1\Http\Cart\Resources\CartResource;
use Domain\Cart\Actions\User\AddProductToCartAction;
use Domain\Cart\Actions\User\CreateCartAction;
use Domain\Cart\Actions\User\DeleteCartAction;
use Domain\Cart\Actions\User\GetUserCartsAction;
use Domain\Cart\Actions\User\RemoveProductFromCartAction;
use Domain\Cart\DataTransferObjects\ProductCartData;
use Domain\Cart\DataTransferObjects\CreateCartData;
use Domain\Cart\Models\Cart;
use Domain\Product\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $this->authorize('view', app(Cart::class));

        $carts = GetUserCartsAction::run($request->user()->id);

        return CartResource::paginatedCollection($carts);
    }

    public function store(CreateCartRequest $request): JsonResponse
    {
        $this->authorize('create', app(Cart::class));

        $data = ['user_id' => $request->user()->id, 'name' => $request->name];

        $cart = CreateCartAction::run(CreateCartData::from($data));

        return $cart
            ? $this->okResponse(CartResource::make($cart))
            : $this->failedResponse();
    }

    public function destroy(Cart $cart): JsonResponse
    {
        $this->authorize('delete', $cart);

        DB::beginTransaction();

        try {
            $result = DeleteCartAction::run($cart->id);
            DB::commit();
        } catch (\Exception $e) {
            $result = false;
            DB::rollBack();
        }

        return $result
            ? $this->okResponse()
            : $this->failedResponse();
    }

    public function add(AddProductToCartRequest $request, Cart $cart, Product $product): JsonResponse
    {
        $this->authorize('add', $cart);

        DB::beginTransaction();

        try {
            $result = AddProductToCartAction::run(ProductCartData::from($request));
            DB::commit();
        } catch (\Exception $e) {
            $result = false;
            DB::rollBack();
        }

        return $result
            ? $this->okResponse()
            : $this->failedResponse();
    }

    public function remove(RemoveProductFromCartRequest $request, Cart $cart, Product $product): JsonResponse
    {
        $this->authorize('remove', $cart);

        DB::beginTransaction();

        try {
            $result = RemoveProductFromCartAction::run(ProductCartData::from($request));
            DB::commit();
        } catch (\Exception $e) {
            $result = false;
            DB::rollBack();
        }

        return $result
            ? $this->okResponse()
            : $this->failedResponse();
    }
}
