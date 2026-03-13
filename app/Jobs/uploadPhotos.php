<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;

class uploadPhotos implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public $oldPath;
    public function __construct(string $oldPath)
    {
        $this->oldPath = $oldPath;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $fileName = basename($this->oldPath);
        $newPath =  'UserImages/' . $fileName;
        Storage::disk('public')->move($this->oldPath , $newPath);
    }
}
