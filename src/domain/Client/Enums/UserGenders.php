<?php

namespace Domain\Client\Enums;

use Shared\Traits\EnumHelper;

enum UserGenders: string
{
    use EnumHelper;
    case MALE = 'male';
    case FEMALE = 'female';
    case OTHER = 'other';
}
