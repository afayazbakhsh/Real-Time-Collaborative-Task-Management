<?php

namespace App\Services\Task;

use App\Models\Project;
use App\Models\Task;

readonly class TaskService
{
    public function create(array $data): Task
    {
        return Task::create($data);
    }

    public function update(Task $task, array $data): bool
    {
        return $task->update($data);
    }
}
