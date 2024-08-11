<?php

namespace App\Services;

use App\Models\Project;

class ProjectService
{
    public function create(array $data): Project
    {
        return Project::create($data);
    }
}
