<?php

namespace App\User\v1\Http\Order\Controllers;

use App\Http\Controllers\Controller;
use App\User\v1\Http\Order\Requests\ConfirmOrderRequest;
use App\User\v1\Http\Order\Requests\CreateOrderRequest;
use Domain\Order\Actions\User\CheckUserActiveOrdersAction;
use Domain\Order\Actions\User\ConfirmOrderAction;
use Domain\Order\Actions\User\CreateOrderAction;
use Domain\Order\DataTransferObjects\OrderData;
use Domain\Order\Models\Order;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Shared\Helpers\ErrorResult;

class OrderController extends Controller
{
    public function store(CreateOrderRequest $request): JsonResponse
    {
        $this->authorize('create', app(Order::class));

        if (CheckUserActiveOrdersAction::run($request->user()->id)) {
            return $this->unauthorizedResponse('You can not create more than one active order');
        }

        DB::beginTransaction();

        $orderEPayment = CreateOrderAction::run(OrderData::from($request));

        if ($orderEPayment instanceof ErrorResult) {
            DB::rollBack();
            return $this->failedResponse();
        }

        DB::commit();
        Cache::put($orderEPayment->ePayment->gatewayClientPaymentId, $orderEPayment, 3600);

        return $this->okResponse();
    }

    public function confirm(ConfirmOrderRequest $request): JsonResponse
    {
        $this->authorize('confirm', app(Order::class));

        $gatewayClientPaymentId = $request->get('gateway_client_payment_id');
        if (Cache::missing($gatewayClientPaymentId)) return $this->failedResponse('Payment not found.');

        DB::beginTransaction();
        $result = ConfirmOrderAction::run(Cache::get($gatewayClientPaymentId));
        if ($result instanceof ErrorResult) {
            DB::rollBack();
            return $this->failedResponse();
        }

        DB::commit();
        Cache::forget($gatewayClientPaymentId);

        return $this->okResponse();
    }
}
