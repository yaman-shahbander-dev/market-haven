<?php

namespace Domain\Client\Enums;

use Shared\Traits\EnumHelper;

enum PermissionEnum: string
{
    use EnumHelper;

    case USER_VIEW_ANY = 'user.view.*';
    case USER_CREATE = 'user.create.*';
    case USER_UPDATE = 'user.update.*';
    case USER_DELETE = 'user.delete.*';

    case CATEGORY_VIEW_ANY = 'category.view.*';
    case CATEGORY_CREATE = 'category.create.*';
    case CATEGORY_UPDATE = 'category.update.*';
    case CATEGORY_DELETE = 'category.delete.*';
}
