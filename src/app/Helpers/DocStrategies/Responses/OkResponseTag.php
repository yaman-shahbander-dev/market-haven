<?php

namespace App\Helpers\DocStrategies\Responses;

use App\Enums\StatusCodes\HttpStatus;

class OkResponseTag extends AbstractResponseTag
{
    protected int $status = HttpStatus::OK->value;
    protected string $tag = 'okResponse';

    protected function getContent(): string
    {
        return "{\"message\": \"{$this->getMessage()}\",\"data\": null}";
    }
}
