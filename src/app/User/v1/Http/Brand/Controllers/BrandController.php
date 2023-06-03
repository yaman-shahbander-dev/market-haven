<?php

namespace App\User\v1\Http\Brand\Controllers;

use App\User\v1\Http\Brand\Resources\BrandResource;
use App\Http\Controllers\Controller;
use Domain\Brand\Actions\GetBrandsAction;
use Domain\Brand\Actions\ShowBrandAction;
use Domain\Brand\Models\Brand;
use Illuminate\Http\JsonResponse;

class BrandController extends Controller
{
    public function index(): JsonResponse
    {
        $this->authorize('view', app(Brand::class));

        $brands = GetBrandsAction::run();

        return BrandResource::paginatedCollection($brands);
    }

    public function show(string $brand): JsonResponse
    {
        $this->authorize('view', app(Brand::class));

        $brand = ShowBrandAction::run($brand);

        return $brand
            ? $this->okResponse(BrandResource::make($brand))
            : $this->notFoundResponse();
    }
}
