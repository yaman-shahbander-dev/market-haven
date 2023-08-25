<?php

namespace App\Admin\v1\Http\Location\Controllers;

use App\Admin\v1\Http\Location\Resources\CityResource;
use App\Http\Controllers\Controller;
use Domain\Location\Actions\Shared\City\GetCitiesAction;
use Domain\Location\Actions\Shared\City\ShowCityAction;
use Domain\Location\Models\City;
use Illuminate\Http\JsonResponse;

class CityController extends Controller
{
    public function index(): JsonResponse
    {
        $this->authorize('view', app(City::class));

        $cities = GetCitiesAction::run();

        return CityResource::paginatedCollection($cities);
    }

    public function show(City $city): JsonResponse
    {
        $this->authorize('view', app(City::class));

        $city = ShowCityAction::run($city->id);

        return $city
            ? $this->okResponse(CityResource::make($city))
            : $this->notFoundResponse();
    }
}
