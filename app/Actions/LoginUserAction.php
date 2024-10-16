<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class LoginUserAction
{
    /**
     * @throws AuthenticationException
     */
    public function execute(array $data): User
    {
        if ($token = Auth::attempt($data)) {

            $user = Auth::user();

            $user->token = $token;

            return $user;
        }

        throw new AuthenticationException('Invalid credentials');
    }
}
