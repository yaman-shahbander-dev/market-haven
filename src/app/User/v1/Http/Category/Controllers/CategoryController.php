<?php

namespace App\User\v1\Http\Category\Controllers;

use App\Http\Controllers\Controller;
use App\User\v1\Http\Category\Resources\CategoryResource;
use Domain\Category\Actions\GetCategoriesAction;
use Domain\Category\Actions\ShowCategoryAction;
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
}
