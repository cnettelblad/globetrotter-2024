<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSubmissionRequest;
use App\Http\Requests\UpdateSubmissionRequest;
use App\Models\Contestant;
use App\Models\Submission;

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
        $contestant->submissions()->create($request->validated());

        return redirect()->route('dashboard');
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
