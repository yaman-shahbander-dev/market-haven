<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class DataNotFoundException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json(['data' => 'Data not found'], Response::HTTP_NOT_FOUND, []);
    }
}
