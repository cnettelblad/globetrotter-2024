<?php

use App\Http\Controllers\ContestantController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\ImportFailureController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubmissionController;
use App\Models\Contestant;
use App\Models\ImportFailure;
use App\Models\Submission;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home', [
        'canLogin' => Route::has('login'),
        'contestants' => Contestant::with('submissions')->get(),
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/submissions', [SubmissionController::class, 'all'])->name('submissions.index');
    Route::resource('contestants', ContestantController::class);
    Route::resource('contestants.submissions', SubmissionController::class)->shallow();

    Route::prefix('/import')->name('import.')->group(function () {
        Route::get('/', [ImportController::class, 'index'])->name('index');
        Route::post('/discord', [ImportController::class, 'discord'])->name('discord');
        Route::post('/csv', [ImportController::class, 'csv'])->name('csv');
        Route::delete('/failures/{importFailure}', ImportFailureController::class)->name('failures.destroy');
    });
});

require __DIR__ . '/auth.php';
