<?php

namespace App\Models\Concerns;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

trait HasMediaAttribute
{
    /**
     * Upload the given file to cloudinary in the given folder and return the public id.
     */
    public function uploadAndReturnPath($value, string $folder): mixed
    {
        if ($value instanceof UploadedFile || Str::startsWith($value, 'http')) {
            return Cloudinary::upload((string) $value, ['folder' => $folder])->getFileName();
            // Todo: Send a PR to cloudinary to fix this return typehint error.
        }

        return $value;
    }
}
