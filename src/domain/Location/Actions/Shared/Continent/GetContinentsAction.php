<?php

namespace Domain\Location\Actions\Shared\Continent;

use Domain\Location\DataTransferObjects\ContinentData;
use Domain\Location\Models\Continent;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\LaravelData\PaginatedDataCollection;
use Spatie\QueryBuilder\QueryBuilder;

class GetContinentsAction
{
    use AsAction;

    public function __construct(
        protected Continent $continent
    ) {
    }

    public function handle(): PaginatedDataCollection
    {
        $continents = QueryBuilder::for($this->continent)
            ->paginate();

        return ContinentData::collection($continents);
    }
}
