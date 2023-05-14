<?php

namespace App\User\v1\Http\Category\Controllers;

use App\Http\Controllers\Controller;
use App\User\v1\Http\Category\Resources\CategoryResource;
use Domain\Category\Actions\GetCategoriesAction;
use Domain\Category\Actions\ShowCategoryAction;
use Domain\Category\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
        $this->authorize('view', new Category());

        $categories = GetCategoriesAction::run();
        return $categories
            ? $this->okResponse($categories)
            : $this->failedResponse();
    }

    public function show(string $category): JsonResponse
    {
        $this->authorize('view', new Category());

        $category = ShowCategoryAction::run($category);

        return $category
            ? $this->okResponse(CategoryResource::make($category))
            : $this->notFoundResponse();
    }
}
