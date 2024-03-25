<?php

namespace App;

use Illuminate\Support\Facades\Storage;

trait MediaUploader
{
    function uploadMedia($file, $name, $dir,  $old = null, $disk = 'public')
    {
        if ($file && !is_string($file)) {
            if ($old) {
                Storage::disk('public')->delete($old);
            }
            $fileName = str($name)->slug() . "." . $file->getClientOriginalExtension();
            $filePath = $file->storeAs($dir, $fileName, $disk);
            return $filePath;
        }
    }

    function removeMedia($old, $disk = 'public')
    {
        if ($old) {
            Storage::disk($disk)->delete($old);
        }
    }
}
