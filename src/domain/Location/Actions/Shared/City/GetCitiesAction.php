<?php

namespace Domain\Location\Actions\Shared\City;

use Domain\Location\DataTransferObjects\CityData;
use Domain\Location\Models\City;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\LaravelData\PaginatedDataCollection;
use Spatie\QueryBuilder\QueryBuilder;

class GetCitiesAction
{
    use AsAction;

    public function __construct(
        protected City $city
    ) {
    }

    public function handle(): PaginatedDataCollection
    {
        $cities = QueryBuilder::for($this->city)
            ->allowedIncludes(['addresses'])
            ->paginate();

        return CityData::collection($cities);
    }
}
