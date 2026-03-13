<?php

namespace App\Services;

use App\Jobs\uploadPhotos;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class FileService
{
    public function handleUploadPhoto($user , $request)
    {
        $uuid = (string) Str::uuid();
        $extension = $request['image']->getClientOriginalExtension();
        $filename = $uuid . '.' . $extension;
        $tempPath = $request['image']->storeAs('Temporary', $filename, 'public');

        uploadPhotos::dispatch($tempPath , $user);

        if ($user->image) {
            Storage::disk('public')->delete($user->image);
        }

        $newPath =  'UserImages/' . basename($tempPath);
        return $newPath;
    }
}