<?php

namespace Domain\Order\States;

use Domain\Order\States\OrderState;

class Pending extends OrderState
{
    public static $name = 'pending';
}
