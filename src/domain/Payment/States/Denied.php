<?php

namespace Domain\Payment\States;

use Domain\Payment\States\PaymentState;

class Denied extends PaymentState
{
    public static $name = 'denied';
}
