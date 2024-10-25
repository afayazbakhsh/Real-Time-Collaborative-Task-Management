<?php

namespace App\Services\Task;

use App\Models\Project;
use App\Models\Task;

readonly class TaskService
{
    public function create(Project $project, array $data): Task
    {
        return $project->tasks()->create($data);
    }
}
