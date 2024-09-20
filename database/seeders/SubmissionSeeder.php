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
        $contestants = Contestant::all();
        $months = Collect([
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
        ]);

        $contestants->each(function ($contestant) use ($months) {
            $submissions = $months->random(rand(1, 12))->map(
                fn($month) => Submission::factory()->make([
                    'month' => $month
                ])
            );
            $contestant->submissions()->saveMany($submissions);
        });
    }
}
