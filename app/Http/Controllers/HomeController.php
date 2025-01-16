<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContestantResource;
use App\Models\Contestant;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return Inertia::render('Home', [
            'contestants' => ContestantResource::collection(
                Contestant::query()
                    ->with('submissions')
                    ->withCount('submissions')
                    ->orderBy('submissions_count', 'desc')
                    ->orderBy('nickname')
                    ->get()
            )
        ]);
    }
}
