<?php

namespace App\Traits;

use App\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasMedia
{
    /**
     * Define polymorphic relationship
     */
    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    /**
     * Handle single file upload and attach to the model.
     */
    public function addMedia(UploadedFile $file, string $directory = 'uploads')
    {
        $filePath = $file->store($directory, 'public');

        return $this->media()->create([
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $filePath,
        ]);
    }

    /**
     * Handle removing old file and uploading new file and attach to the model.
     */
    public function updateMedia(UploadedFile $file, string $directory = 'uploads')
    {
        $this->clearMedia();
        $filePath = $file->store($directory, 'public');

        return $this->media()->create([
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $filePath,
        ]);
    }

    /**
     * Delete a specific media file
     */
    public function removeMedia(Media $media)
    {
        if (Storage::disk('public')->exists($media->file_path)) {
            Storage::disk('public')->delete($media->file_path);
        }

        return $media->delete();
    }

    /**
     * Delete all media related to this model.
     */
    public function clearMedia()
    {
        if ($this->media()->exists()) {
            if ($this->media->count() > 1) {
                foreach ($this->media as $media) {
                    $this->removeMedia($media);
                }
            } else {
                $this->removeMedia($this->media);
            }
        }
    }
}
