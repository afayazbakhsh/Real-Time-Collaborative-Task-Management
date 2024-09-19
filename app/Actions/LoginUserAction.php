<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginUserAction
{
    public function execute(array $data): User|NULL
    {
        if ($token = Auth::attempt($data)) {

            $user = Auth::user();

            $user->token = $token;

            return $user;
        }
    }
}
