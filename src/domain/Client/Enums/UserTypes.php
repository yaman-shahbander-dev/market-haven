<?php

namespace Domain\Client\Enums;

use Shared\Traits\EnumHelper;

enum UserTypes: string
{
    use EnumHelper;
    case ADMIN = 'admin';
    case USER = 'user';
}
