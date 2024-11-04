<?php

namespace App\Http\Controllers;

use App\Models\ImportFailure;
use Illuminate\Http\Request;

class ImportFailureController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ImportFailure $importFailure)
    {
        $importFailure->delete();

        return redirect()->back();
    }
}
