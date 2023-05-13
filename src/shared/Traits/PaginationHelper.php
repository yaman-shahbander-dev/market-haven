<?php

namespace Shared\Traits;


use Shared\Helpers\PaginatedCollectionData;

trait PaginationHelper
{
    public static function paginatedCollection(PaginatedCollectionData $data): PaginatedCollectionData
    {
        $data->data = static::collection($data->data);
        return $data;
    }
}
