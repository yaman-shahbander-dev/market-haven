<?php

namespace App\Exceptions\Client;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class UserNotFoundException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json(['data' => 'User not found'], Response::HTTP_NOT_FOUND, []);
    }
}
