<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportContestantsRequest;
use App\Http\Requests\UpdateContestantRequest;
use App\Jobs\ImportContestantsFromCsv;
use App\Models\Contestant;
use App\Services\DiscordService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Inertia\Inertia;

class ContestantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Contestants/List', [
            'contestants' => Contestant::withCount([
                'submissions as score',
                'submissions as lacks_image' => function ($query) {
                    $query->whereNull('image');
                }
            ])->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Contestants/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /**
         * @var DiscordService $discordService
         */
        $discordService = App::make(DiscordService::class);
        $discordUser = $discordService->getUser($request->input('discord_id'));

        if (!$discordUser) {
            return redirect()->route('contestants.create')->withErrors([
                'discord_id' => 'Discord user not found.'
            ]);
        }

        $contestant = Contestant::fromDiscordUser($discordUser);

        return redirect()->route('contestants.edit', $contestant);
    }

    /**
     * Display the specified resource.
     */
    public function show(Contestant $contestant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contestant $contestant)
    {
        return Inertia::render('Contestants/Edit', [
            'contestant' => $contestant->load('submissions')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContestantRequest $request, Contestant $contestant)
    {
        $contestant->update($request->validated());

        return redirect()->route('contestants.edit', $contestant);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contestant $contestant)
    {
        //
    }
}
