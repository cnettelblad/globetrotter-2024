<?php

use App\Http\Controllers\Api\V1 as V1;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->name('api.v1.')->group(function () {
    Route::get('destinations', V1\DestinationSearchController::class)->name('destinations.index');
    Route::get(
        'submissions/countries',
        [V1\SubmissionController::class, 'countByDestinations']
    )->name('submissions.countries');
    Route::apiResource('contestants', V1\ContestantController::class);
})->middleware('auth:sanctum');
