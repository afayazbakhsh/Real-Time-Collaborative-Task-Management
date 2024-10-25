<?php

namespace App\Http\Requests\Project;

use App\Enums\RoleTypesEnum;
use App\Http\Requests\RequestAbstract;

class CreateProjectRequest extends RequestAbstract
{
    protected array $access = ['roles' => [RoleTypesEnum::Admin->value]];

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'image' => ['file', 'mimes:jpg,png,jpeg', 'max:4000'],
        ];
    }
}
