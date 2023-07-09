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
                PermissionEnum::BRAND_VIEW_ANY->value,
                PermissionEnum::BRAND_CREATE->value,
                PermissionEnum::BRAND_UPDATE->value,
                PermissionEnum::BRAND_DELETE->value,
                PermissionEnum::PRODUCT_VIEW_ANY->value,
                PermissionEnum::PRODUCT_CREATE->value,
                PermissionEnum::PRODUCT_UPDATE->value,
                PermissionEnum::PRODUCT_DELETE->value,
                PermissionEnum::CART_VIEW_ANY->value,
            ],
            self::USER->value => [
                PermissionEnum::USER_VIEW_ANY->value,
                PermissionEnum::CATEGORY_VIEW_ANY->value,
                PermissionEnum::BRAND_VIEW_ANY->value,
                PermissionEnum::PRODUCT_VIEW_ANY->value,
                PermissionEnum::CART_VIEW_ANY->value,
            ]
        ];
    }
}
