<?php

namespace App\User\v1\Http\Product\Controllers;

use App\User\v1\Http\Favorite\Resources\FavoriteResource;
use App\User\v1\Http\Product\Requests\AddFavoriteRequest;
use App\User\v1\Http\Product\Requests\DeleteFavoriteRequest;
use App\User\v1\Http\Product\Resources\ProductResource;
use App\Http\Controllers\Controller;
use Domain\Favorite\Actions\User\AddFavoriteAction;
use Domain\Favorite\Actions\User\DeleteFavoriteAction;
use Domain\Favorite\DataTransferObjects\FavoriteData;
use Domain\Product\Actions\GetProductsAction;
use Domain\Product\Actions\SearchProductsAction;
use Domain\Product\Actions\ShowProductAction;
use Domain\Product\Models\Product;
use Illuminate\Http\JsonResponse;

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

    public function search(string $search): JsonResponse
    {
        $products = SearchProductsAction::run($search);

        return ProductResource::paginatedCollection($products);
    }

    public function addFavorite(AddFavoriteRequest $request): JsonResponse
    {
        $favorite = AddFavoriteAction::run(FavoriteData::from($request));

        return $favorite
            ? $this->okResponse(FavoriteResource::make($favorite))
            : $this->failedResponse();
    }

    public function deleteFavorite(DeleteFavoriteRequest $request): JsonResponse
    {
        $result = DeleteFavoriteAction::run(FavoriteData::from($request));

        return $result
            ? $this->okResponse()
            : $this->failedResponse();
    }
}
