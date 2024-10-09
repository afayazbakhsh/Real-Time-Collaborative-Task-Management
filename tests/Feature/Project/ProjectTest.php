<?php

namespace Tests\Feature\Project;

use App\Models\Project;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Exceptions;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RoleSeeder::class);

        $this->user = User::factory()->createOne();
    }

    public function test_project_index(): void
    {
        Exceptions::fake();

        Project::factory()->count(10)->create();

        $response = $this->actingAs($this->user)->getJson(route('projects.create'));

        $response->assertOk();

        $response->assertJson(
            fn (AssertableJson $json) => $json->has('data', length: 10)->etc()
        );

        Exceptions::assertNotReported(Exceptions::class);
        Exceptions::assertNothingReported();

    }

    public function test_admin_can_create_project(): void
    {
        $this->user->assignRole('admin');

        $projectData = Project::factory()->make([
            'title' => 'Test Project',
            'user_id' => $this->user->id,
        ])->toArray();

        $response = $this->actingAs($this->user)
            ->postJson(route('projects.create'), $projectData);

        $response->assertCreated();


        $response->assertJson(fn (AssertableJson $json) => $json->hasAll(['title', 'user_id'])
            ->where('title', $projectData['title'])
            ->where('user_id', $this->user->id)
            ->missing('fake_column')
            ->etc()
        );

        $this->assertDatabaseHas('projects', [
            'title' => $projectData['title'],
            'user_id' => $this->user->id,
        ]);
    }
}
