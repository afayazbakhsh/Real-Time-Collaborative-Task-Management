<?php

namespace Feature\Task;

use App\Models\Project;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Exceptions;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use DatabaseMigrations;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->createOne();

        $this->seed(RoleSeeder::class);

    }

    public function test_create_task_by_user(): void
    {
        Exceptions::fake();

        $response = $this->actingAs($this->user)->postJson(route('projects.tasks.create-task'));

        $response->assertOk();

        $response->assertJson(
            fn (AssertableJson $json) => $json->has('data', length: 20)->etc()
        );

        Exceptions::assertNotReported(Exceptions::class);
        Exceptions::assertNothingReported();
    }
}
