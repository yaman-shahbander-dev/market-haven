<?php

namespace Domain\Location\Actions\Shared\City;

use Domain\Location\DataTransferObjects\CityData;
use Domain\Location\Models\City;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class ShowCityAction
{
    use AsAction;

    public function __construct(
        protected City $city
    ) {
    }

    public function handle(string $id): CityData
    {
        $city = QueryBuilder::for($this->city)
            ->allowedIncludes(['addresses'])
            ->where('id', $id)
            ->first();

        return CityData::from($city);
    }
}
