<?php

namespace App\Console\Commands;

use App\Jobs\CreateThumbnails;
use App\Models\Submission;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class GenerateThumbnails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-thumbnails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates thumbnails for all images in the storage directory';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Submission::all()->each(function (Submission $submission) {
            if (!$submission->image || !Storage::exists($submission->image)) {
                $this->warn("Skipping $submission->image on $submission->id because it does not exist", 'v');
                return;
            }

            $this->info("Generating thumbnails for $submission->image", 'v');
            CreateThumbnails::dispatchSync($submission->image);
        });
    }
}
