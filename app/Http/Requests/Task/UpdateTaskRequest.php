<?php

namespace App\Http\Requests\Task;

use App\Http\Requests\RequestAbstract;
use App\Models\Task;

/**
 * @property Task $task
 */
class UpdateTaskRequest extends RequestAbstract
{
    public function authorize(): bool
    {
        return parent::authorize() && $this->task->user->id == $this->user()->id;
    }

    public function rules(): array
    {
        return [
            'title' => 'string|max:255',
            'description' => 'nullable|string|max:5000',
        ];
    }
}
