<?php

namespace Domain\Payment\Enums;

use Shared\Traits\EnumHelper;

enum PaymentGatewayEnum: string
{
    use EnumHelper;

    case PAYPAL = 'paypal';
    case STRIPE = 'stripe';
}
