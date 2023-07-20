<?php

namespace Domain\Payment\States;

use Domain\Payment\States\Approved;
use Domain\Payment\States\Captured;
use Domain\Payment\States\Created;
use Domain\Payment\States\Denied;
use Domain\Payment\States\Failed;
use Domain\Payment\States\Succeed;
use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class PaymentState extends State
{
    private string $field = 'state';

    /**
     * @throws \Spatie\ModelStates\Exceptions\InvalidConfig
     */
    public static function config(): StateConfig
    {
        return parent::config()->default(Created::class)
            ->allowTransition(
                [
                    Created::class,
                    Approved::class,
                    Captured::class,
                    Denied::class,
                    Failed::class,
                    Succeed::class
                ],
                Created::class
            )->allowTransition(
                [
                    Created::class,
                    Approved::class,
                    Captured::class,
                    Denied::class,
                    Failed::class,
                    Succeed::class
                ],
                Approved::class
            )->allowTransition(
                [
                    Created::class,
                    Approved::class,
                    Captured::class,
                    Denied::class,
                    Failed::class,
                    Succeed::class
                ],
                Captured::class
            )->allowTransition(
                [
                    Created::class,
                    Approved::class,
                    Captured::class,
                    Denied::class,
                    Failed::class,
                    Succeed::class
                ],
                Denied::class
            )->allowTransition(
                [
                    Created::class,
                    Approved::class,
                    Captured::class,
                    Denied::class,
                    Failed::class,
                    Succeed::class
                ],
                Failed::class
            )->allowTransition(
                [
                    Created::class,
                    Approved::class,
                    Captured::class,
                    Denied::class,
                    Failed::class,
                    Succeed::class
                ],
                Succeed::class
            );
    }
}
