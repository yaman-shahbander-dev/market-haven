<?php

namespace Domain\Order\States;

use Domain\Order\States\OrderState;
class Captured extends OrderState
{
    public static $name = 'captured';
}
