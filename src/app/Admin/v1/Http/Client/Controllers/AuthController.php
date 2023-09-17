<?php

namespace App\Admin\v1\Http\Client\Controllers;

use App\Admin\v1\Http\Client\Requests\LoginRequest;
use App\Admin\v1\Http\Client\Resources\AdminResource;
use App\Http\Controllers\Controller;
use Domain\Client\Actions\Admin\LoginAction;
use Domain\Client\Actions\Shared\RevokeTokenAction;
use Domain\Client\DataTransferObjects\AuthData;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
   public function login(LoginRequest $request): JsonResponse
   {
       $admin = LoginAction::run(AuthData::from($request));
       return $admin
           ? $this->okResponse(AdminResource::make($admin))
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
