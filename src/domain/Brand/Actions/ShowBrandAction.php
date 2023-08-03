<?php

namespace Domain\Brand\Actions;

use Domain\Brand\DataTransferObjects\BrandData;
use Domain\Brand\Models\Brand;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class ShowBrandAction
{
    use AsAction;

    public function __construct(
        protected Brand $brand
    ) {
    }

    public function handle(string $id): BrandData|null
    {
        $brand = QueryBuilder::for($this->brand)
            ->where('id', $id)
            ->first();

        return $brand ? BrandData::from($brand) : null;
    }
}
