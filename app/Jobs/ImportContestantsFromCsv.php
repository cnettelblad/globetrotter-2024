<?php

namespace App\Jobs;

use App\Enums\Month;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ImportContestantsFromCsv implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public string $csv) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $csv = array_map(
            'str_getcsv',
            explode("\n", $this->csv)
        );

        $header = array_shift($csv);

        foreach ($csv as $row) {
            $data = collect(array_combine($header, $row));

            if (!$data->get('ID')) {
                continue;
            }

            ProcessDiscordContestant::dispatch(
                (int) $data->get('ID'),
                $data->only(Month::toArray())->filter()
            );
        }
    }
}
