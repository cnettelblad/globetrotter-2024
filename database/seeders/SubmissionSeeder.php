<?php

namespace Database\Seeders;

use App\Models\Submission;
use Illuminate\Database\Seeder;

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
            $data = array_combine($header, $row);

            foreach ($months as $month) {
                if (isset($data[$month]) && $data[$month] !== '') {
                    Submission::create([
                        'discord_id' => $data['ID'],
                        'month' => $month,
                        'submission' => $data[$month],
                    ]);
                }
            }
        }
    }
}
