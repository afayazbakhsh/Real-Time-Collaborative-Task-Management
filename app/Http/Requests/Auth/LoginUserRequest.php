<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\RequestAbstract;

class LoginUserRequest extends RequestAbstract
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|string|email|max:255|exists:users,email',
            'password' => 'required|string|min:6',
            'remember' => 'bool',
        ];
    }
}
