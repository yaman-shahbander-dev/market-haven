<?php

namespace Domain\Client\Actions\Shared;

use Domain\Client\Managers\IManagers\IProviderManager;
use Lorisleiva\Actions\Concerns\AsAction;

class ProviderLoginAction
{
    use AsAction;

    public function __construct(
        protected IProviderManager $IProviderManager
    ) {
    }

    public function handle(string $provider)
    {
        return $this->IProviderManager->make($provider)->redirect($provider);
    }
}
