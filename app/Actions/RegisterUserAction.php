<?php

namespace App\Actions;

use App\Models\User;
use App\Tasks\GetTokenTask;
use Illuminate\Support\Facades\DB;

class RegisterUserAction
{
    public function __construct(private readonly GetTokenTask $getTokenTask)
    {
    }

    public function execute(array $data): User
    {
        return DB::transaction(function() use ($data){

            $user = User::create($data);

            $token = $this->getTokenTask->token($user);

            $user->token = $token;

            return $user;
        });
    }
}
