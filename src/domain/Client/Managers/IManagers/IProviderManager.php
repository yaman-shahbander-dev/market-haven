<?php

namespace Domain\Client\Managers\IManagers;

use Domain\Client\Services\IServices\IProviderService;

interface IProviderManager
{
    public function make(string $provider): IProviderService;
}
