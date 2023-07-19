<?php

namespace App\User\v1\Http\Order\Controllers;

use App\Http\Controllers\Controller;
use App\User\v1\Http\Order\Requests\ConfirmOrderRequest;
use App\User\v1\Http\Order\Requests\CreateOrderRequest;
use Domain\Order\Actions\User\ConfirmOrderAction;
use Domain\Order\Actions\User\CreateOrderAction;
use Domain\Order\DataTransferObjects\OrderData;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(CreateOrderRequest $request): JsonResponse
    {
        //$this->authorize()
        DB::beginTransaction();

        try {
            $orderEPayment = CreateOrderAction::run(OrderData::from($request));
            Cache::put($orderEPayment->ePayment->gatewayClientPaymentId, $orderEPayment, 7200);
            DB::commit();
        } catch (\Exception $exception) {
            $orderEPayment = false;
            DB::rollBack();
        }

        return $orderEPayment
            ? $this->okResponse()
            : $this->failedResponse();
    }

    public function confirm(ConfirmOrderRequest $request)
    {
        //$this->authorize()
        $gatewayClientPaymentId = $request->get('gateway_client_payment_id');
        if (Cache::missing($gatewayClientPaymentId)) return $this->failedResponse('Payment not found.');

        $result = ConfirmOrderAction::run(Cache::get($gatewayClientPaymentId));

//        Cache::forget($gatewayClientPaymentId);
        return $result;
    }
}
