<?php

namespace Domain\Payment\States;

use Domain\Payment\States\PaymentState;

class Failed extends PaymentState
{
    public static $name = 'failed';
}
