<?php

namespace Domain\Client\Enums;

use Shared\Traits\EnumHelper;

enum UserScopes: string
{
    use EnumHelper;
    case ADMIN = 'admin';
    case USER = 'user';
}
