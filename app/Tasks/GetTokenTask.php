<?php

namespace App\Tasks;

use App\Models\User;

class GetTokenTask
{
    public function token(User $user): string
    {
        return auth()->login($user);
    }
}
