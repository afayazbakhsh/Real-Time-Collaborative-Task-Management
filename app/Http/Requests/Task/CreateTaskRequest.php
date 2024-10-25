<?php

namespace App\Http\Requests\Task;

use App\Enums\RoleTypesEnum;
use App\Http\Requests\RequestAbstract;
use App\Models\Project;

/**
 * @property Project $project
 */
class CreateTaskRequest extends RequestAbstract
{
    protected array $access = ['roles' => [RoleTypesEnum::Admin->value]];

    public function authorize(): bool
    {
        return Parent::authorize() && $this->project->user_id = $this->user()->id;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:5000',
        ];
    }
}
