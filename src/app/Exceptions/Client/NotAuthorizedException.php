<?php

namespace App\Exceptions\Client;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class NotAuthorizedException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json(['data' => 'Access was not authorized by the user.'], Response::HTTP_UNAUTHORIZED, []);
    }
}
