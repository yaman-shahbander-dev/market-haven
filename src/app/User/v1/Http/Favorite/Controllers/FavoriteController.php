<?php

namespace App\User\v1\Http\Favorite\Controllers;

use App\Http\Controllers\Controller;
use Domain\Favorite\Actions\User\GetFavoritesAction;
use Domain\Favorite\Models\Favorite;
use App\User\v1\Http\Favorite\Resources\FavoriteResource;
use Illuminate\Http\JsonResponse;

class FavoriteController extends Controller
{
    public function index(): JsonResponse
    {
        $this->authorize('view', app(Favorite::class));

        $favorites = GetFavoritesAction::run();

        return FavoriteResource::paginatedCollection($favorites);
    }
}
