<?php

namespace Domain\Client\Managers\Managers;

use Domain\Client\Managers\IManagers\IProviderManager;
use Domain\Client\Services\IServices\IProviderService;
use Domain\Client\Services\Services\GithubService;
use Illuminate\Support\Facades\App;

class ProviderManager implements IProviderManager
{
    public function make(string $provider): IProviderService
    {
        $createdMethod = 'create' . ucfirst($provider) . 'Service';
        return $this->{$createdMethod}();
    }

    public function createGithubService(): GithubService
    {
        return App::make(GithubService::class);
    }
}
