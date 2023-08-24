<?php

namespace Domain\Location\Actions\Shared\Country;

use Domain\Location\DataTransferObjects\CountryData;
use Domain\Location\Models\Country;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class ShowCountryAction
{
    use AsAction;

    public function __construct(
        protected Country $country
    ) {
    }

    public function handle(string $id): CountryData
    {
        $country = QueryBuilder::for($this->country)
            ->where('id', $id)
            ->first();

        return CountryData::from($country);
    }
}
