<?php

namespace App\Docs;

/**
 * @OA\Post(
 *     path="/api/projects",
 *     summary="Create a new project",
 *     description="Creates a new project based on the provided request data.",
 *     tags={"Projects"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name", "description"},
 *             @OA\Property(property="name", type="string", example="New Project"),
 *             @OA\Property(property="description", type="string", example="This is a sample project description."),
 *             @OA\Property(property="start_date", type="string", format="date", example="2024-09-27"),
 *             @OA\Property(property="end_date", type="string", format="date", example="2024-12-31")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Project created successfully"
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid request data"
 *     )
 * )
 */
class ProjectDocs
{
    // No methods needed, only documentation
}
