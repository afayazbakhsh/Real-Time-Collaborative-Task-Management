<?php

namespace App\Tasks;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AddMediaToModelTask
{
    /**
     * @throws FileIsTooBig
     * @throws FileDoesNotExist
     */
    public function run(HasMedia $model, UploadedFile $file, string $collectionName = 'public'): Media
    {
        return $model->addMedia($file)->toMediaCollection($collectionName);
    }
}
