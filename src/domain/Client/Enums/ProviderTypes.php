<?php

namespace Domain\Client\Enums;

use Shared\Traits\EnumHelper;

enum ProviderTypes: string
{
    use EnumHelper;
    case GITHUB = 'github';
}
