<?php

namespace App\Http\Requests\Task;

use App\Http\Requests\RequestAbstract;
use App\Models\Project;
use Illuminate\Validation\Rule;

/**
 * @property Project $project
 */
class CreateTaskRequest extends RequestAbstract
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:5000',
            'project_id' => [
                'required',
                Rule::exists('projects', 'id')->where('user_id', $this->user()->id)]
        ];
    }
}
