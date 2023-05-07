<?php

namespace Domain\Client\Services\IServices;

interface IProviderService
{
    public function redirect(string $provider);
    public function callback(string $provider);
}
