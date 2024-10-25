<?php

namespace App\Services\Project;

use App\Models\Project;
use App\Tasks\AddMediaToModelTask;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

readonly class ProjectService
{
    public function __construct(private AddMediaToModelTask $mediaToModelTask)
    {
    }

    public function index(): Collection
    {
        return Project::with(['media', 'tasks'])->get();
    }

    public function create(array $data): Project
    {
        return DB::transaction(function () use ($data) {

            $project = Project::create($data);

            if (isset($data['image'])) {
                $this->mediaToModelTask->run($project, $data['image'], 'projects');
            }

            return $project;
        });
    }
}
