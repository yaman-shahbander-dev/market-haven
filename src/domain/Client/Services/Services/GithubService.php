<?php

namespace Domain\Client\Services\Services;

use Domain\Client\Actions\User\RegisterUserAction;
use Domain\Client\DataTransferObjects\AuthData;
use Domain\Client\Services\IServices\IProviderService;
use Laravel\Socialite\Facades\Socialite;

class GithubService implements IProviderService
{
    public function redirect(string $provider)
    {
        return Socialite::driver($provider)->stateless()->redirect()->getTargetUrl();
    }

    public function callback(string $provider)
    {
        $user = Socialite::driver($provider)->stateless()->user()->user;

        return RegisterUserAction::run(AuthData::from($user));
    }
}
