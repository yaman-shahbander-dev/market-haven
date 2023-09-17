<?php

namespace Shared\Helpers;

use Shared\Traits\PaginationHelper;
use Spatie\LaravelData\Data;

class BaseData extends Data
{
    use PaginationHelper;
}
