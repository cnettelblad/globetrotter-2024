<?php

namespace Database\Seeders;

use App\Enums\DestinationType;
use App\Models\Destination;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $destinations = File::json(
            'database/seeders/resources/destinations.json'
        );

        foreach ($destinations["countries"] as $country) {
            Destination::create([
                'name' => $country['name'],
                'emoji' => $country['emoji'],
                'type' => DestinationType::COUNTRY,
                'code' => $country['alpha2'],
            ]);
        }

        foreach ($destinations["states"] as $state) {
            Destination::create([
                'name' => $state['name'],
                'emoji' => $state['emoji'],
                'type' => DestinationType::STATE,
                'code' => $state['iso'],
            ]);
        }

        foreach ($destinations["special"] as $special) {
            Destination::create([
                'name' => $special['name'],
                'emoji' => $special['emoji'],
                'type' => DestinationType::OTHER,
            ]);
        }
    }
}
