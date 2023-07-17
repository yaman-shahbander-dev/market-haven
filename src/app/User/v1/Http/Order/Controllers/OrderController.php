<?php

namespace App\User\v1\Http\Order\Controllers;

use App\Http\Controllers\Controller;
use App\User\v1\Http\Order\Requests\CreateOrderRequest;
use Domain\Order\Actions\User\CreateOrderAction;
use Domain\Order\DataTransferObjects\OrderData;

class OrderController extends Controller
{
    public function store(CreateOrderRequest $request)
    {
        //$this->authorize()

        // DB transaction

        $result = CreateOrderAction::run(OrderData::from($request));

//        return $result
//            ? $this->okResponse()
//            : $this->failedResponse();

        return $result;
    }
}
