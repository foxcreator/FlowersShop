<?php

namespace App\Http\Services;

use App\Http\Services\Contracts\FileStorageServiceContract;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

class FileStorageService implements FileStorageServiceContract
{
    public static function upload(UploadedFile | string $file): string
    {
        if (is_string($file)) {
            return str_replace('public/storage', '', $file);
        }
        $fileName = static::randomName() . '.' . $file->getClientOriginalExtension();
        $filePath = 'public/' . $fileName;

        Storage::put($filePath, File::get($file));

        return $filePath;
    }

    public static function remove($file)
    {
        Storage::delete($file);
    }

    protected static function randomName(): string
    {
        return Str::random() . '_' . time();
    }
}
