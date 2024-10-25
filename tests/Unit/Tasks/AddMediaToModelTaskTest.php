<?php
namespace Tests\Unit\Tasks;

use App\Models\Project;
use App\Tasks\AddMediaToModelTask;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

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

        $file = UploadedFile::fake()->image('test.jpg');

        $media = resolve(AddMediaToModelTask::class)->run($project, $file);

        $this->assertEquals('test.jpg', $media->file_name);

        Storage::disk('public')->assertExists($media->getPathRelativeToRoot());

    }
}
