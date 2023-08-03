<?php

namespace App\Admin\v1\Http\Product\Controllers;

use App\Admin\v1\Http\Product\Requests\CreateProductRequest;
use App\Admin\v1\Http\Product\Requests\UpdateProductRequest;
use App\Admin\v1\Http\Product\Resources\ProductResource;
use App\Http\Controllers\Controller;
use Domain\Product\Actions\DeleteProductAction;
use Domain\Product\Actions\DirectorProductAction;
use Domain\Product\Actions\GetProductsAction;
use Domain\Product\Actions\ShowProductAction;
use Domain\Product\Actions\UpdateProductAction;
use Domain\Product\DataTransferObjects\CreateOrUpdateProductData;
use Domain\Product\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(): JsonResponse
    {
        $this->authorize('view', app(Product::class));

        $products = GetProductsAction::run();

        return ProductResource::paginatedCollection($products);
    }

    public function show(Product $product): JsonResponse
    {
        $this->authorize('view', app(Product::class));

        $product = ShowProductAction::run($product->id);

        return $product
            ? $this->okResponse(ProductResource::make($product))
            : $this->notFoundResponse();
    }

    public function store(CreateProductRequest $request): JsonResponse
    {
        $this->authorize('create', app(Product::class));

        DB::beginTransaction();

        try {
            $product = DirectorProductAction::run($request->all());
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
        }

        return $product
            ? $this->okResponse(ProductResource::make($product))
            : $this->failedResponse();
    }

    public function update(UpdateProductRequest $request, Product $product): JsonResponse
    {
        $this->authorize('update', $product);

        DB::beginTransaction();

        try {
            $result = UpdateProductAction::run(CreateOrUpdateProductData::from($request));
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
        }

        return $result
            ? $this->okResponse()
            : $this->failedResponse();
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

        $result = DeleteProductAction::run($product->id);

        return $result
            ? $this->okResponse()
            : $this->failedResponse();
    }
}
