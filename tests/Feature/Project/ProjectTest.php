<?php

namespace Feature\Project;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Exceptions;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use DatabaseMigrations;

    public function test_project_index(): void
    {
        Exceptions::fake();

        $user = User::factory()->create();

        $projects = Project::factory()->count(10)->create();

        $response = $this->actingAs($user)->getJson('api/projects');

        $response->assertSuccessful();

        $response->assertJson(
            fn (AssertableJson $json) => $json->has('data', length: 10)->etc()
        );

        // Assert exception...
        Exceptions::assertNotReported(Exceptions::class);
        Exceptions::assertNothingReported();

    }

    public function test_project_create(): void
    {
        $user = User::factory()->create();

        // Use 'make' to generate unsaved project data
        $project = Project::factory()->make(['title', 'user_id' => $user->id])->toArray();

        // Send POST request
        $response = $this->actingAs($user)->postJson('api/projects', $project);

        // Assert status 201 (Created)
        $response->assertCreated();

        // Assert the JSON response structure
        $response->assertJson(fn (AssertableJson $json) => $json->hasAll(['title', 'user_id'])->missing('fake_column')->etc()
            ->where('title', $project['title']) // Check title matches
            ->where('user_id', $user->id) // Check user_id matches
        );
    }
}
