<?php

namespace Domain\Location\Actions\Shared\Country;

use Domain\Location\DataTransferObjects\CountryData;
use Domain\Location\Models\Country;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\LaravelData\PaginatedDataCollection;
use Spatie\QueryBuilder\QueryBuilder;

class GetCountriesAction
{
    use AsAction;

    public function __construct(
        protected Country $country
    ) {
    }

    public function handle(): PaginatedDataCollection
    {
        $countries = QueryBuilder::for($this->country)
            ->paginate();

        return CountryData::collection($countries);
    }
}
