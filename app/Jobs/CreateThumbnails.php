<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;
use Spatie\Image\Enums\Fit;
use Spatie\Image\Image;

class CreateThumbnails implements ShouldQueue
{
    use Queueable;

    public function __construct(protected string $path)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $path = Storage::path($this->path);
        $img = Image::load($path);

        $extension = pathinfo($this->path, PATHINFO_EXTENSION);

        $img->fit(Fit::Contain, 128, 128)
            ->save(Storage::path(str_replace(".$extension", "-x128.webp", $this->path)));

        $img->fit(Fit::Contain, 64, 64)
            ->save(Storage::path(str_replace(".$extension", "-x64.webp", $this->path)));
    }
}
