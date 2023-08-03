<?php

namespace Domain\Payment\States;

use Domain\Payment\States\PaymentState;

class Captured extends PaymentState
{
    public static $name = 'captured';
}
