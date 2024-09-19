<?php

namespace App\Jobs;

use App\Models\Contestant;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

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
                Log::info("Importing discord user: {$data->get('ID')}");
                $contestant = Contestant::fromDiscordId($data->get('ID'));
            }

            foreach ($months as $month) {
                if (!$data->has($month) || $contestant->submissions?->contains('month', $month)) {
                    continue;
                }

                if ($data->get($month)) {
                    $contestant->submissions()->create([
                        'month' => $month,
                        'submission' => $data->get($month),
                        'image' => $data->get('image') ?? null
                    ]);
                }
            }
        }
    }
}
