<?php

namespace Domain\Client\Actions\Shared;

use App\Exceptions\Client\NotAuthorizedException;
use Domain\Client\DataTransferObjects\GithubData;
use Domain\Client\Enums\ProviderTypes;
use Domain\Client\Managers\IManagers\IProviderManager;
use Lorisleiva\Actions\Concerns\AsAction;

class GithubCallbackAction
{
    use AsAction;

    public function __construct(
      protected IProviderManager $IProviderManager
    ) {
    }

    public function handle(GithubData $githubData)
    {
        if (!$githubData->code) throw new NotAuthorizedException();

        return $this->IProviderManager->make(ProviderTypes::GITHUB->value)->callback(ProviderTypes::GITHUB->value);
    }
}
