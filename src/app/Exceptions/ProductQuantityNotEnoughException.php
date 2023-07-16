<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class ProductQuantityNotEnoughException extends Exception
{
    public function __construct(public $title)
    {
        parent::__construct();
    }

    public function render(): JsonResponse
    {
        return response()->json(['data' => 'There is not enough quantity for product' . $this->title], Response::HTTP_BAD_REQUEST, []);
    }
}
