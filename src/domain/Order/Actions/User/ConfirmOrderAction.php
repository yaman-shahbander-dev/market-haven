<?php

namespace Domain\Order\Actions\User;

use Domain\Payment\Actions\ConfirmPaymentAction;
use Domain\Payment\DataTransferObjects\OrderEPaymentData;
use Lorisleiva\Actions\Concerns\AsAction;

class ConfirmOrderAction
{
    use AsAction;

    public function __construct() { }

    public function handle(OrderEPaymentData $data)
    {
        $user = auth()->user();
        if ($user->id !== $data->order->userId) return false;

        return ConfirmPaymentAction::run($data);
    }
}
