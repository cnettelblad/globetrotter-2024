<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportCsvRequest;
use App\Jobs\ImportContestantsFromCsv;
use App\Models\ImportFailure;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ImportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Import/Import', [
            'failures' => ImportFailure::with('contestant')->get(),
        ]);
    }

    /**
     * Import contestants from a CSV file.
     */
    public function csv(ImportCsvRequest $request)
    {
        $csv = $request->file('csv')->get();

        ImportContestantsFromCsv::dispatch($csv);

        return redirect()->route('import.index');
    }
}
