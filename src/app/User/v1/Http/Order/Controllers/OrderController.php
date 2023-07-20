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
            Cache::put($orderEPayment->ePayment->gatewayClientPaymentId, $orderEPayment, 28800);
            DB::commit();
        } catch (\Exception $exception) {
            $orderEPayment = false;
            DB::rollBack();
        }

        return $orderEPayment
            ? $this->okResponse()
            : $this->failedResponse();
    }

    public function confirm(ConfirmOrderRequest $request)//: JsonResponse
    {
        //$this->authorize()
        $gatewayClientPaymentId = $request->get('gateway_client_payment_id');
        if (Cache::missing($gatewayClientPaymentId)) return $this->failedResponse('Payment not found.');

        return ConfirmOrderAction::run(Cache::get($gatewayClientPaymentId));
        DB::beginTransaction();
        try {
            $result = ConfirmOrderAction::run(Cache::get($gatewayClientPaymentId));
            DB::commit();
        } catch (\Exception $exception) {
            $result = false;
            DB::rollBack();
        }

        Cache::forget($gatewayClientPaymentId);
        return $result
            ? $this->okResponse()
            : $this->failedResponse();
    }
}
