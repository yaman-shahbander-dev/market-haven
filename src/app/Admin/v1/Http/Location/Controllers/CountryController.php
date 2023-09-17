<?php

namespace App\Admin\v1\Http\Location\Controllers;

use App\Admin\v1\Http\Location\Resources\CountryResource;
use App\Http\Controllers\Controller;
use Domain\Location\Actions\Shared\Country\GetCountriesAction;
use Domain\Location\Actions\Shared\Country\ShowCountryAction;
use Domain\Location\Models\Country;
use Illuminate\Http\JsonResponse;

class CountryController extends Controller
{
    public function index(): JsonResponse
    {
        $this->authorize('view', app(Country::class));

        $countries = GetCountriesAction::run();

        return CountryResource::paginatedCollection($countries);
    }

    public function show(Country $country): JsonResponse
    {
        $this->authorize('view', app(Country::class));

        $country = ShowCountryAction::run($country->id);

        return $country
            ? $this->okResponse(CountryResource::make($country))
            : $this->notFoundResponse();
    }
}
