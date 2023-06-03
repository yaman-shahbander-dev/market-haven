<?php

namespace Domain\Brand\Actions;

use Domain\Brand\DataTransferObjects\BrandData;
use Domain\Brand\Models\Brand;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class CreateBrandAction
{
    use AsAction;

    public function __construct(
        protected Brand $brand
    ) {
    }

    public function handle(BrandData $data): BrandData|null
    {
        $brand = QueryBuilder::for($this->brand)
            ->create([
                'name' => $data->name,
            ]);

        return $brand ? BrandData::from($brand) : null;
    }
}
