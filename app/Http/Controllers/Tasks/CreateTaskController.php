<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\CreateTaskRequest;
use App\Models\Project;
use App\Services\Task\TaskService;

class CreateTaskController extends Controller
{
    public function __construct(private readonly TaskService $service)
    {
    }

    public function __invoke(Project $project, CreateTaskRequest $request)
    {
        return $this->service->create($request->validated());
    }
}
