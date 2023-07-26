<?php
namespace Domain\Order\States;

use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class OrderState extends State
{
    private string $field = 'state';

    /**
     * @throws \Spatie\ModelStates\Exceptions\InvalidConfig
     */
    public static function config(): StateConfig
    {
        return parent::config()->default(Pending::class)
            ->allowTransition(Pending::class, Pending::class)
            ->allowTransition(Pending::class, Captured::class);
    }
}
