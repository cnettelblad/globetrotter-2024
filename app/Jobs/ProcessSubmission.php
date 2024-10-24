<?php

namespace App\Jobs;

use App\Enums\Month;
use App\Models\Contestant;
use App\Models\Destination;
use App\Models\ImportFailure;
use App\Models\Submission;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Collection;

class ProcessSubmission implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Contestant $contestant,
        public Month $month,
        public string $destination
    ) {}

    public function handle()
    {
        $destinations = Destination::whereNameLike(
            $this->destination
        )->get();

        if ($destinations->isEmpty()) {
            $failure = new ImportFailure([
                'key' => $this->month->value,
                'value' => $this->destination,
                'error' => "Destination not found",
            ]);
            $failure->contestant()->associate($this->contestant);
            $failure->save();

            return;
        }

        /**
         * If there are multiple destinations with similar names,
         * select the one with the smallest Levenshtein distance.
         *
         * @var Destination $destination
         */
        if ($destinations->count() > 1) {
            $destination = $destinations->sortBy(
                fn($dest) => levenshtein(
                    $dest->name,
                    $this->destination
                )
            )->first();
        } else {
            $destination = $destinations->first();
        }

        $submission = new Submission([
            'month' => $this->month,
        ]);

        $submission->destination()->associate($destination);
        $submission->contestant()->associate($this->contestant);
        $submission->save();
    }
}
