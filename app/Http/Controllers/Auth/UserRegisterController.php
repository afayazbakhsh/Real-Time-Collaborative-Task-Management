<?php

namespace App\Http\Controllers\Auth;

use App\Actions\RegisterUserAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Resources\UserLoginResource;

class UserRegisterController extends Controller
{
    public function __construct(private readonly RegisterUserAction $action)
    {
    }

    public function __invoke(RegisterUserRequest $request)
    {
        $user = $this->action->execute($request->validated());

        return UserLoginResource::make($user);
    }
}
