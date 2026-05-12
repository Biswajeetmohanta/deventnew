<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\UploadedFile;

trait HandlesDirectImageUploads
{
    /**
     * Upload an image directly to public/storage/ folder.
     *
     * @param UploadedFile $file
     * @param string $folder
     * @return string
     */
    protected function uploadImageDirect(UploadedFile $file, string $folder)
    {
        $filename = time() . '_' . $file->getClientOriginalName();
        $targetDir = public_path('storage/' . $folder);
        
        // Auto-create folder if not exists
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0755, true);
        }
        
        // Move file directly to public path
        $file->move($targetDir, $filename);
        
        // Return the path to be saved in DB (consistent with store() method)
        return $folder . '/' . $filename;
    }

    /**
     * Delete an image directly from public/storage/ folder.
     *
     * @param string|null $path
     * @return void
     */
    protected function deleteImageDirect(?string $path)
    {
        if (!$path) {
            return;
        }

        $filePath = public_path('storage/' . $path);
        
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
}
