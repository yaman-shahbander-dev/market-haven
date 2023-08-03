<?php

namespace App\Enums\StatusCodes;

use Illuminate\Http\Response;

enum HttpStatus: int
{
    case OK = Response::HTTP_OK;
    case BAD_REQUEST = Response::HTTP_BAD_REQUEST;
    case UNAUTHORIZED = Response::HTTP_UNAUTHORIZED;
    case HTTP_FORBIDDEN = Response::HTTP_FORBIDDEN;
    case NOT_FOUND = Response::HTTP_NOT_FOUND;
    case UNPROCESSABLE_ENTITY = Response::HTTP_UNPROCESSABLE_ENTITY;
    case INTERNAL_SERVER_ERROR = Response::HTTP_INTERNAL_SERVER_ERROR;

    public static function txt(int $code): string
    {
        return Response::statusTexts($code) ?? 'Unknown';
    }

    public static function msg(int $code): string
    {
        return self::statusTexts($code) ?? 'Unknown';
    }

    public static function statusTexts(int $code): string
    {
        return match ($code) {
            self::OK => 'Operation succeeded.',
            self::BAD_REQUEST => 'Operation failed.',
            self::UNAUTHORIZED => 'Unauthorized.',
            self::HTTP_FORBIDDEN => 'Forbidden.',
            self::NOT_FOUND => 'Not Found.',
            self::UNPROCESSABLE_ENTITY => 'Validation failed.',
            self::INTERNAL_SERVER_ERROR => 'Internal Server Error.',
            default => 'Unknown status code.',
        };
    }
}
