<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageUploader
{
    public static function store(?UploadedFile $file, string $directory, ?string $currentUrl = null): ?string
    {
        if (! $file) {
            return null;
        }

        self::deleteIfLocal($currentUrl);

        $path = $file->store($directory, 'public');

        return Storage::disk('public')->url($path);
    }

    public static function deleteIfLocal(?string $url): void
    {
        if (! $url || ! str_contains($url, '/storage/')) {
            return;
        }

        $path = parse_url($url, PHP_URL_PATH);

        if (! is_string($path)) {
            return;
        }

        $relativePath = ltrim(str_replace('/storage/', '', $path), '/');

        if ($relativePath !== '') {
            Storage::disk('public')->delete($relativePath);
        }
    }
}
