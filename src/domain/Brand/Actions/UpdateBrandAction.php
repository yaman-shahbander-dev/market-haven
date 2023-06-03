<?php

namespace Domain\Brand\Actions;

use Domain\Brand\DataTransferObjects\BrandData;
use Domain\Brand\Models\Brand;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class UpdateBrandAction
{
    use AsAction;

    public function __construct(
        protected Brand $brand
    ) {
    }

    public function handle(BrandData $data): bool
    {
        return QueryBuilder::for($this->brand)
            ->where('id', $data->id)
            ->update([
                'name' => $data->name
            ]);
    }
}
