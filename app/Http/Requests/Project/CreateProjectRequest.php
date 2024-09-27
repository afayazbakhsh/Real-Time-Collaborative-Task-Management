<?php

namespace App\Http\Requests\Project;

use App\Http\Requests\RequestAbstract;

class CreateProjectRequest extends RequestAbstract
{
    protected array $access = [
        'roles' => ['admin']
    ];

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
        ];
    }
}
