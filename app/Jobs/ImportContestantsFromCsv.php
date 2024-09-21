<?php

namespace App\Jobs;

use App\Models\Contestant;
use App\Models\Destination;
use App\Models\ImportFailure;
use App\Models\Submission;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ImportContestantsFromCsv // implements ShouldQueue
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
        Log::debug("Importing contestants from CSV");

        $csv = array_map(
            'str_getcsv',
            explode("\n", $this->csv)
        );

        $months = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ];

        $header = array_shift($csv);

        foreach ($csv as $row) {
            $data = collect(array_combine($header, $row));

            if (!$data->get('ID')) {
                continue;
            }

            /**
             * @var ?Contestant $contestant
             */
            $contestant = Contestant::where(
                'discord_id',
                $data->get('ID')
            )->with('submissions')->first();

            if (!$contestant) {
                if (!is_int($data->get('ID'))) {
                    $failure = new ImportFailure([
                        'key' => 'ID',
                        'value' => $data->get('ID'),
                        'error' => "Invalid ID for Discord user",
                    ]);
                    $failure->save();

                    continue;
                }

                $contestant = Contestant::fromDiscordId($data->get('ID'));
            }

            foreach ($months as $month) {
                if (!$data->get($month) || !is_string($data->get($month))) {
                    continue;
                }

                if ($contestant->submissions->contains('month', $month)) {
                    continue;
                }

                $destination = Destination::whereLike(
                    'name',
                    "%" . $data->get($month) . "%"
                )->first();

                if (!$destination) {
                    $failure = new ImportFailure([
                        'key' => $month,
                        'value' => $data->get($month),
                        'error' => "Destination not found",
                    ]);
                    $failure->contestant()->associate($contestant);
                    $failure->save();

                    continue;
                }

                $submission = new Submission([
                    'month' => $month,
                ]);

                $submission->destination()->associate($destination);
                $submission->contestant()->associate($contestant);
                $submission->save();
            }
        }
    }
}
