<?php

namespace Database\Factories;

use App\Enums\ProjectStatusEnum;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        return [
            'title' => fake()->title,
            'status' => ProjectStatusEnum::Active->value,
            'user_id' => User::factory(),
        ];
    }
}
