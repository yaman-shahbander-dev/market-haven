<?php

namespace Domain\Location\Actions\Shared\Address;

use Domain\Location\DataTransferObjects\AddressData;
use Domain\Location\Models\Address;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class ShowAddressAction
{
    use AsAction;

    public function __construct(
        protected Address $address
    ) {
    }

    public function handle(string $id): AddressData
    {
        $address = QueryBuilder::for($this->address)
            ->allowedIncludes(['city', 'order'])
            ->where('id', $id)
            ->first();

        return AddressData::from($address);
    }
}
