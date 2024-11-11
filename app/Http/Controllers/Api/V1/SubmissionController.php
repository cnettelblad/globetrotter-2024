<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Contestant;
use App\Models\Destination;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Submission::all()->toJson();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function countByDestinations(Request $request)
    {
        $destinations = Destination::query()
            ->has('submissions', '>', 1)
            ->withCount('submissions')
            ->get();

        return JsonResource::collection(
            $destinations->map(
                fn($destination) => [
                    'id' => $destination->id,
                    'name' => $destination->name,
                    'emoji' => $destination->emoji,
                    'type' => $destination->type,
                    'code' => $destination->code,
                    'submissions_count' => $destination->submissions_count
                ]
            )
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Contestant $contestant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contestant $contestant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contestant $contestant)
    {
        //
    }
}
