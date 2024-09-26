<?php

use App\Http\Controllers\ContestantController;
use App\Http\Controllers\ImportController;
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

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/submissions', [SubmissionController::class, 'all'])->name('submissions.index');
    Route::resource('contestants', ContestantController::class);
    Route::resource('contestants.submissions', SubmissionController::class)->shallow();

    Route::get('/import', function () {
        return Inertia::render('Import/Import', [
            'failures' => ImportFailure::with('contestant')->get(),
        ]);
    })->name('import.index');

    Route::post('contestants/import', [ImportController::class, 'csv'])->name('contestants.import');
});

require __DIR__ . '/auth.php';
