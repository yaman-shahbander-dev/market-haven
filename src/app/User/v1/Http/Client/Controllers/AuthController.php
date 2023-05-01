<?php

namespace App\User\v1\Http\Client\Controllers;

use App\Admin\v1\Http\Client\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\User\v1\Http\Client\Requests\RegisterRequest;
use App\User\v1\Http\Client\Resources\UserResource;
use Domain\Client\Actions\User\LoginAction;
use Domain\Client\Actions\Admin\RevokeTokenAction;
use Domain\Client\Actions\User\RegisterUserAction;
use Domain\Client\DataTransferObjects\AuthData;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = RegisterUserAction::run(AuthData::from($request));
        return $user
            ? $this->okResponse(UserResource::make($user))
            : $this->failedResponse();
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $user = LoginAction::run(AuthData::from($request));
        return $user
            ? $this->okResponse(UserResource::make($user))
            : $this->failedResponse();
    }

    public function logout(Request $request): JsonResponse
    {
        $result = RevokeTokenAction::run($request->user());
        return $result
            ? $this->okResponse()
            : $this->failedResponse();
    }
}
