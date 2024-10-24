<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSubmissionRequest;
use App\Http\Requests\UpdateSubmissionRequest;
use App\Models\Contestant;
use App\Models\Destination;
use App\Models\Submission;
use Inertia\Inertia;

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Contestant $contestant)
    {
        return view('submissions.index', [
            'contestant' => $contestant,
            'submissions' => $contestant->submissions
        ]);
    }

    /**
     * Display a complete listing of the resource.
     */
    public function all()
    {
        return Inertia::render('Submissions/List', [
            'submissions' => Submission::with('contestant')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Contestant $contestant)
    {
        return view('submissions.create', [
            'contestant' => $contestant
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateSubmissionRequest $request, Contestant $contestant)
    {
        $destination = Destination::where(
            'name',
            $request->input('destination')
        )->firstOrFail();

        $submission = new Submission($request->validated());
        $submission->destination()->associate($destination);
        $submission->contestant()->associate($contestant);
        $submission->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Submission $submission)
    {
        return view('submissions.show', [
            'submission' => $submission
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Submission $submission)
    {
        return view('submissions.edit', [
            'submission' => $submission
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubmissionRequest $request, Submission $submission)
    {
        $submission->update($request->validated());

        return redirect()->route('submissions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Submission $submission)
    {
        $submission->delete();

        return redirect()->route('submissions.index');
    }
}
