<?php

namespace App\Admin\v1\Http\Category\Controllers;

use App\Admin\v1\Http\Category\Requests\CreateCategoryRequest;
use App\Admin\v1\Http\Category\Requests\UpdateCategoryRequest;
use App\Admin\v1\Http\Category\Resources\CategoryResource;
use App\Http\Controllers\Controller;
use Domain\Category\Actions\CreateCategoryAction;
use Domain\Category\Actions\DeleteCategoryAction;
use Domain\Category\Actions\GetCategoriesAction;
use Domain\Category\Actions\ShowCategoryAction;
use Domain\Category\Actions\UpdateCategoryAction;
use Domain\Category\DataTransferObjects\CategoryData;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
        $categories = GetCategoriesAction::run();

        return $categories
            ? $this->okResponse($categories)
            : $this->failedResponse();
    }

    public function show(string $category): JsonResponse
    {
        $category = ShowCategoryAction::run($category);

        return $category
            ? $this->okResponse(CategoryResource::make($category))
            : $this->notFoundResponse();
    }

    public function store(CreateCategoryRequest $request): JsonResponse
    {
        $category = CreateCategoryAction::run(CategoryData::from($request->all()));

        return $category
            ? $this->okResponse(CategoryResource::make($category))
            : $this->failedResponse();
    }

    public function update(UpdateCategoryRequest $request): JsonResponse
    {
        $result = UpdateCategoryAction::run(CategoryData::from($request->all()));

        return $result
            ? $this->okResponse()
            : $this->failedResponse();
    }

    public function destroy(string $category): JsonResponse
    {
        $result = DeleteCategoryAction::run($category);

        return $result
            ? $this->okResponse()
            : $this->failedResponse();
    }
}
