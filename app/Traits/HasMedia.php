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
     * Handle media update with safe replacement
     *
     * @param array|UploadedFile $files New files to upload
     * @param string $directory Storage directory
     * @return array Uploaded media records
     */
    public function updateMedia($files, string $directory = 'uploads')
    {
        // Normalize input to array
        $files = is_array($files) ? $files : [$files];

        // Store new media
        $newMediaRecords = [];
        foreach ($files as $file) {
            if ($file instanceof UploadedFile) {
                $filePath = $file->store($directory, 'public');
                $newMediaRecords[] = $this->media()->create([
                    'file_name' => $file->getClientOriginalName(),
                    'file_path' => $filePath,
                ]);
            }
        }

        // Return newly uploaded media records
        return $newMediaRecords;
    }

    /**
     * Safely remove old media, keeping newly uploaded media
     *
     * @param array $newMediaRecords Newly uploaded media records to preserve
     */
    public function removeOldMedia(array $newMediaRecords = [])
    {
        // Get existing media, excluding newly uploaded media
        $mediaToRemove = $this->media()
            ->when(!empty($newMediaRecords), function ($query) use ($newMediaRecords) {
                $query->whereNotIn('id', array_column($newMediaRecords, 'id'));
            })
            ->get();

        // Remove old media files
        foreach ($mediaToRemove as $media) {
            $this->removeMedia($media);
        }
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
            if ($this->media()->count() > 1) {
                foreach ($this->media as $media) {
                    $this->removeMedia($media);
                }
            } else {
                $this->removeMedia($this->media()->first());
            }
        }
    }
}
