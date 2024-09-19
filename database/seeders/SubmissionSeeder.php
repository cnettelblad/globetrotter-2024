<?php

namespace Database\Seeders;

use App\Models\Contestant;
use App\Models\Submission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class SubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv = array_map('str_getcsv', file('database/seeders/resources/submissions.csv'));

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
            $contestant = Contestant::where(
                'discord_id',
                $data->get('ID')
            )->first();

            echo "Processing {$data->get('ID')}\n";

            if (!$contestant) {
                $contestant = Contestant::fromDiscordId($data->get('ID'));
            }

            foreach ($months as $month) {
                if ($data->has($month) && $data->get($month)) {
                    $contestant->submissions()->create([
                        'month' => $month,
                        'submission' => $data->get($month),
                        'image' => $data->get('Image') ?? null
                    ]);
                }
            }
        }
    }
}
