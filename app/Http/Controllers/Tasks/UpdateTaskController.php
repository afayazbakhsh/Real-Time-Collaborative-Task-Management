<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Models\Project;
use App\Models\Task;
use App\Services\Task\TaskService;

class UpdateTaskController extends Controller
{
    public function __construct(private readonly TaskService $service) {}

    public function __invoke(Project $project, Task $task, UpdateTaskRequest $request): bool
    {
        return $this->service->update($task, $request->validated());
    }
}
