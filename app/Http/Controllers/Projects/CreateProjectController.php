<?php

namespace App\Http\Controllers\Projects;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\CreateProjectRequest;
use App\Services\ProjectService;

class CreateProjectController extends Controller
{
    public function __construct(private readonly ProjectService $service)
    {
    }

    public function __invoke(CreateProjectRequest $request)
    {
        return $this->service->create($request->validated());
    }
}
