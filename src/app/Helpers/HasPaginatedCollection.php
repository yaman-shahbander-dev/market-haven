<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

trait HasPaginatedCollection
{
    public static function paginatedCollection($collection = null, string $message = null, array $headers = []): JsonResponse
    {
        return response()->json([
            'message' => $message ?? 'ok',
            'data' => $collection,
        ], 200, $headers);
    }
}
