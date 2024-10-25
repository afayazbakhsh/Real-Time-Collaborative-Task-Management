<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Media::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'model_type' => fake()->word,
            'model_id' => fake()->randomNumber(1, 100),
            'uuid' => fake()->uuid(),
            'collection_name' => fake()->word(),
            'name' => fake()->word(),
            'file_name' => Str::random(10).'.'.fake()->fileExtension(),
            'mime_type' => fake()->mimeType(),
            'disk' => 'local',
            'conversions_disk' => 'local',
            'size' => fake()->numberBetween(),
            'manipulations' => [],
            'custom_properties' => [],
            'generated_conversions' => [],
            'responsive_images' => [],
            'order_column' => 1,
        ];
    }
}
