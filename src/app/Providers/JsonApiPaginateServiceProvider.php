<?php

namespace App\Providers;

use Carbon\Laravel\ServiceProvider;
use Illuminate\Support\Arr;
use Shared\Helpers\PaginatedCollectionData;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as BaseBuilder;
use Spatie\LaravelData\DataCollection;

class JsonApiPaginateServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerMacro();
    }

    protected function registerMacro()
    {
        $macro = function ($dataClass = null, int $maxResults = null, int $defaultSize = null) {
            $maxResults = $maxResults ?? config('json-api-paginate.max_results');
            $defaultSize = $defaultSize ?? config('json-api-paginate.default_size');
            $numberParameter = config('json-api-paginate.number_parameter');
            $sizeParameter = config('json-api-paginate.size_parameter');
            $paginationParameter = config('json-api-paginate.pagination_parameter');
            $paginationMethod = config('json-api-paginate.use_simple_pagination') ? 'simplePaginate' : 'paginate';

            $size = (int) request()->input($paginationParameter . '.' . $sizeParameter, $defaultSize);
            $size = min($size, $maxResults);

            $paginator = $this->{$paginationMethod}($size, ['*'], $paginationParameter . '.' . $numberParameter)
                ->setPageName($paginationParameter.'['.$numberParameter.']')
                ->appends(Arr::except(request()->input(), $paginationParameter.'.'.$numberParameter));

            if (! is_null(config('json-api-paginate.base_url'))) {
                $paginator->setPath(config('json-api-paginate.base_url'));
            }

            return new PaginatedCollectionData($paginator, new DataCollection($dataClass, $paginator->items()));
        };

        EloquentBuilder::macro(config('json-api-paginate.method_name'), $macro);
        BaseBuilder::macro(config('json-api-paginate.method_name'), $macro);
    }
}
