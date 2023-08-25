<?php

namespace App\User\v1\Http\Location\Controllers;

use App\User\v1\Http\Location\Resources\ContinentResource;
use App\Http\Controllers\Controller;
use Domain\Location\Actions\Shared\Continent\GetContinentsAction;
use Domain\Location\Actions\Shared\Continent\ShowContinentAction;
use Domain\Location\Models\Continent;
use Illuminate\Http\JsonResponse;

class ContinentController extends Controller
{
    public function index(): JsonResponse
    {
        $this->authorize('view', app(Continent::class));

        $continents = GetContinentsAction::run();

        return ContinentResource::paginatedCollection($continents);
    }

    public function show(Continent $continent): JsonResponse
    {
        $this->authorize('view', app(Continent::class));

        $continent = ShowContinentAction::run($continent->id);

        return $continent
            ? $this->okResponse(ContinentResource::make($continent))
            : $this->notFoundResponse();
    }
}
