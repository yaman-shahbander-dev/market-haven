<?php

namespace Domain\Location\Actions\Shared\Address;

use Domain\Location\DataTransferObjects\AddressData;
use Domain\Location\Models\Address;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\LaravelData\PaginatedDataCollection;
use Spatie\QueryBuilder\QueryBuilder;

class GetAddressesAction
{
    use AsAction;

    public function __construct(
        protected Address $address
    ) {
    }

    public function handle(): PaginatedDataCollection
    {
        $addresses = QueryBuilder::for($this->address)
            ->allowedIncludes(['city', 'order'])
            ->paginate();

        return AddressData::collection($addresses);
    }
}
