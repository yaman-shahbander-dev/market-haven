<?php

namespace App\Traits;

use App\Enums\StatusCodes\HttpStatus;
use Exception;
use Shared\Helpers\ErrorResult;
use Stripe\Exception\ApiConnectionException;
use Stripe\Exception\ApiErrorException;
use Stripe\Exception\AuthenticationException;
use Stripe\Exception\CardException;
use Stripe\Exception\InvalidRequestException;

trait StripeHelper
{
    public function getExceptionDto(
        ?Exception $exception = null,
        mixed $state = null,
        ?string $massage = null
    ): ErrorResult {
        $message = $massage ?? $exception?->getMessage();
        if ($exception instanceof CardException) {
            $massage = $exception->getError()->message;
            $state = HttpStatus::UNPROCESSABLE_ENTITY;
        } elseif ($exception instanceof InvalidRequestException) {
            $massage = 'Invalid parameters were supplied to Stripe\'s API';
            $state = HttpStatus::UNPROCESSABLE_ENTITY;
        } elseif ($exception instanceof AuthenticationException) {
            $massage = 'Authentication with Stripe\'s API failed';
            $state = HttpStatus::UNAUTHORIZED;
        } elseif ($exception instanceof ApiConnectionException) {
            $massage = 'Network communication with Stripe failed';
            $state = HttpStatus::BAD_REQUEST;
        } elseif ($exception instanceof ApiErrorException) {
            $massage = 'Payment Server  Error';
            $state = HttpStatus::INTERNAL_SERVER_ERROR;
        }
        return ErrorResult::from([
            'state' => $state,
            'massage' => $massage
        ]);
    }
}
