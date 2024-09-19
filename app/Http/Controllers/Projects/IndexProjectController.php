<?php

namespace App\Http\Controllers\Projects;

use App\Http\Controllers\Controller;
use App\Services\ProjectService;

class IndexProjectController extends Controller
{
    public function __construct(private readonly ProjectService $service)
    {
    }

    public function __invoke()
    {
        return $this->service->index();
    }
}
