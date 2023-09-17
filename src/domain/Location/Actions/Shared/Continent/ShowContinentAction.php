<?php

namespace Domain\Location\Actions\Shared\Continent;

use Domain\Location\DataTransferObjects\ContinentData;
use Domain\Location\Models\Continent;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class ShowContinentAction
{
    use AsAction;

    public function __construct(
        protected Continent $continent
    ) {
    }

    public function handle(string $id): ContinentData
    {
        $continent = QueryBuilder::for($this->continent)
            ->allowedIncludes(['countries'])
            ->where('id', $id)
            ->first();

        return ContinentData::from($continent);
    }
}
