<?php

namespace Shared\Helpers;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Spatie\LaravelData\DataCollection;

final class PaginatedCollectionData
{
    public array $paginator;
    public DataCollection $data;

    public function __construct(LengthAwarePaginator $paginator, DataCollection $data)
    {
        $paginator = $paginator->toArray();
        unset($paginator['data']);
        $this->paginator = $paginator;
        $this->data = $data;
    }
}
