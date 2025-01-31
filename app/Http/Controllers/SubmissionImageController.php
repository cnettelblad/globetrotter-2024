<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class SubmissionImageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Submission $submission)
    {
        $size = $request->input('size');

        if ($size === '64' || $size === '128') {
            $ext = pathinfo($submission->image, PATHINFO_EXTENSION);
            $thumbnailPath = str_replace(".$ext", "-x$size.$ext", $submission->image);

            if (Storage::exists($thumbnailPath)) {
                return Response::file(Storage::path($thumbnailPath));
            } else {
                exit('file not found: ' . $thumbnailPath);
            }
        }

        if (Storage::exists($submission->image)) {
            return Response::file(Storage::path($submission->image));
        }

        abort(404);
    }
}
