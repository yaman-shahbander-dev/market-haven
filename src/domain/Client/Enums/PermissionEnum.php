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

    case BRAND_VIEW_ANY = 'brand.view.*';
    case BRAND_CREATE = 'brand.create.*';
    case BRAND_UPDATE = 'brand.update.*';
    case BRAND_DELETE = 'brand.delete.*';

    case PRODUCT_VIEW_ANY = 'product.view.*';
    case PRODUCT_CREATE = 'product.create.*';
    case PRODUCT_UPDATE = 'product.update.*';
    case PRODUCT_DELETE = 'product.delete.*';

    case CART_VIEW_ANY = 'cart.view.*';
    case CART_CREATE = 'cart.create.*';
    case CART_DELETE = 'cart.delete.*';
    case CART_ADD = 'cart.add.*';
    case CART_REMOVE = 'cart.remove.*';

    case ORDER_CREATE = 'order.create.*';
    case ORDER_CONFIRM = 'order.confirm.*';

    case CONTINENT_VIEW_ANY = 'continent.view.*';

    case COUNTRY_VIEW_ANY = 'country.view.*';

    case CITY_VIEW_ANY = 'city.view.*';

    case ADDRESS_VIEW_ANY = 'address.view.*';
    case ADDRESS_CREATE = 'address.create.*';
}
