<?php

namespace App\Admin\v1\Http\Brand\Controllers;

use App\Admin\v1\Http\Brand\Requests\CreateBrandRequest;
use App\Admin\v1\Http\Brand\Requests\UpdateBrandRequest;
use App\Admin\v1\Http\Brand\Resources\BrandResource;
use App\Http\Controllers\Controller;
use Domain\Brand\Actions\CreateBrandAction;
use Domain\Brand\Actions\DeleteBrandAction;
use Domain\Brand\Actions\GetBrandsAction;
use Domain\Brand\Actions\ShowBrandAction;
use Domain\Brand\Actions\UpdateBrandAction;
use Domain\Brand\DataTransferObjects\BrandData;
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

    public function store(CreateBrandRequest $request): JsonResponse
    {
        $this->authorize('create', Brand::class);

        $brand = CreateBrandAction::run(BrandData::from($request));

        return $brand
            ? $this->okResponse(BrandResource::make($brand))
            : $this->failedResponse();
    }

    public function update(UpdateBrandRequest $request, Brand $brand): JsonResponse
    {
        $this->authorize('update', $brand);

        $result = UpdateBrandAction::run(BrandData::from($request));

        return $result
            ? $this->okResponse()
            : $this->failedResponse();
    }

    public function destroy(Brand $brand): JsonResponse
    {
        $this->authorize('delete', $brand);

        $result = DeleteBrandAction::run($brand->id);

        return $result
            ? $this->okResponse()
            : $this->failedResponse();
    }
}
