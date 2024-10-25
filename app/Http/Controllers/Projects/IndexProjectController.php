<?php

namespace App\Http\Controllers\Projects;

use App\Http\Controllers\Controller;
use App\Http\Resources\Project\ProjectCollection;
use App\Services\Project\ProjectService;

class IndexProjectController extends Controller
{
    public function __construct(private readonly ProjectService $service)
    {
    }

    public function __invoke()
    {
        return ProjectCollection::collection($this->service->index());
    }
}
