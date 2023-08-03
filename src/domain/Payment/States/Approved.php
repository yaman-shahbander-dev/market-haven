<?php

namespace Domain\Payment\States;

use Domain\Payment\States\PaymentState;

class Approved extends PaymentState
{
    public static $name = 'approved';
}
