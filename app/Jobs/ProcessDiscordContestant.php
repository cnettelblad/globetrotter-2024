<?php

namespace App\Jobs;

use App\Enums\Month;
use App\Models\Contestant;
use App\Models\Destination;
use App\Models\ImportFailure;
use App\Models\Submission;
use App\Services\DiscordService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;

class ProcessDiscordContestant implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public int $id,
        public iterable $submissions = []
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        /**
         * @var DiscordService $discordService
         */
        $discordService = App::make(DiscordService::class);
        $discordUser = $discordService->getUser($this->id);

        if (!$discordUser) {
            ImportFailure::create([
                'key' => 'discord_id',
                'value' => $this->id,
                'error' => 'Discord User does not seem to exist'
            ]);

            return;
        }

        $contestant = Contestant::fromDiscordUser($discordUser);

        foreach ($this->submissions as $key => $submission) {
            $month = Month::tryFrom($key);

            if (!$month) {
                $failure = new ImportFailure([
                    'key' => $month,
                    'value' => $key,
                    'error' => 'Invalid month'
                ]);
                $failure->contestant()->associate($contestant);
                $failure->save();

                continue;
            }

            ProcessSubmission::dispatch(
                $contestant,
                $month,
                $submission
            );
        }
    }
}
