<?php

namespace App\Http\Controllers\Projects;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\CreateProjectRequest;
use App\Services\Project\ProjectService;

class CreateProjectController extends Controller
{
    public function __construct(private readonly ProjectService $service)
    {
    }

    /**
     * @OA\Get(
     *     path="/api/user",
     *     summary="Get user info",
     *     tags={"User"},
     *     @OA\Response(
     *         response=200,
     *         description="User info retrieved successfully",
     *     ),
     * )
     */
    public function __invoke(CreateProjectRequest $request)
    {
        return $this->service->create($request->validated());
    }
}
