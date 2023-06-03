<?php

namespace Domain\Brand\Actions;

use Domain\Brand\DataTransferObjects\BrandData;
use Domain\Brand\Models\Brand;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\LaravelData\PaginatedDataCollection;
use Spatie\QueryBuilder\QueryBuilder;

class GetBrandsAction
{
    use AsAction;

    public function __construct(
        protected Brand $brand
    ) {
    }

    public function handle(): PaginatedDataCollection
    {
        $brands = QueryBuilder::for($this->brand)
            ->paginate();

        return BrandData::collection($brands);
    }
}
