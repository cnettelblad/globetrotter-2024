<?php

namespace Database\Seeders;

use App\Models\Contestant;
use App\Models\Submission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use function Laravel\Prompts\progress;

class ContestantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!env('DISCORD_TOKEN')) {
            Contestant::factory()->count(20)->create();

            return;
        }

        $discordUsers = new Collection([
            '1091484180342378546',
            '1025477315054030931',
            '1111785262289277050',
            '1090372582781497424',
            '53908232506183680',
            '1088605561446203402',
            '103559217914318848',
            '1046815986348732466',
            '933123872641921044',
            '907769093950697542',
            '1059899583867654166',
            '175988497612537856',
            '945746117268762695',
            '1049765238699991050',
            '90919521224761344',
            '90339695967350784',
            '872217606969516042',
            '776533885286088745',
            '167348773423415296',
            '82198898843586560',
            '90919521224761344',
            '144631340749422592'
        ]);

        progress(
            'Seeding Contestants',
            $discordUsers,
            function ($discordId, $progress) {
                $progress->label("Importing: $discordId");
                Contestant::fromDiscordId($discordId);
            },
            'This takes a little while...'
        );
    }
}
