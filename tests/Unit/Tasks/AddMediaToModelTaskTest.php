<?php
namespace Tests\Unit\Tasks;

use App\Models\Project;
use App\Tasks\AddMediaToModelTask;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;  // Change the base class to Laravel's TestCase

class AddMediaToModelTaskTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    public function test_add_media_to_model_successfully(): void
    {
        $project = Project::factory()->createOne();

        $file1 = UploadedFile::fake()->image('test');

        resolve(AddMediaToModelTask::class)->run($project, $file1);

        $file = $project->media()->first();

        $this->assertCount(1, $project->getMedia());

        $this->assertEquals('test', $file->file_name);

        Storage::disk('public')->assertExists($file->getPath());
    }
}
