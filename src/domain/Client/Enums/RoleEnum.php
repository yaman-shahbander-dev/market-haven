<?php

namespace Domain\Client\Enums;

use Shared\Traits\EnumHelper;

enum RoleEnum: string
{
    use EnumHelper;
    case ADMIN = 'admin';
    case USER = 'user';

    public static function getRolesPermissions(): array
    {
        return [
            self::ADMIN->value => [
                PermissionEnum::USER_VIEW_ANY->value,
                PermissionEnum::USER_CREATE->value,
                PermissionEnum::USER_UPDATE->value,
                PermissionEnum::USER_DELETE->value,
                PermissionEnum::CATEGORY_VIEW_ANY->value,
                PermissionEnum::CATEGORY_CREATE->value,
                PermissionEnum::CATEGORY_UPDATE->value,
                PermissionEnum::CATEGORY_DELETE->value,
            ],
            self::USER->value => [
                PermissionEnum::USER_VIEW_ANY->value,
                PermissionEnum::USER_CREATE->value,
                PermissionEnum::USER_UPDATE->value,
                PermissionEnum::USER_DELETE->value,
                PermissionEnum::CATEGORY_VIEW_ANY,
            ]
        ];
    }
}
