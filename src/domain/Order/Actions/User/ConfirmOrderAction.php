<?php

namespace Domain\Order\Actions\User;

use Domain\Payment\Actions\ConfirmPaymentAction;
use Domain\Payment\DataTransferObjects\OrderEPaymentData;
use Lorisleiva\Actions\Concerns\AsAction;
use Shared\Helpers\ErrorResult;

class ConfirmOrderAction
{
    use AsAction;

    public function __construct() { }

    public function handle(OrderEPaymentData $data): bool|ErrorResult
    {
        $user = auth()->user();
        if ($user->id !== $data->order->userId) return ErrorResult::from([]);

        return ConfirmPaymentAction::run($data);
    }
}
