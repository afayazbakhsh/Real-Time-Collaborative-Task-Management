<?php

namespace App\Http\Controllers\Auth;

use App\Actions\LoginUserAction;
use App\Actions\RegisterUserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginUserRequest;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Http\Resources\UserLoginResource;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(
        private readonly RegisterUserAction $registerUserAction,
        private readonly LoginUserAction $loginUserAction
    ) {}

    public function register(RegisterUserRequest $request): JsonResource
    {
        $user = $this->registerUserAction->execute($request->validated());

        return UserLoginResource::make($user);
    }

    /**
     * @throws AuthenticationException
     */
    public function login(LoginUserRequest $request): JsonResponse|JsonResource
    {
        $user = $this->loginUserAction->execute($request->validated());

        return UserLoginResource::make($user);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Successfully logged out']);

    }
}
