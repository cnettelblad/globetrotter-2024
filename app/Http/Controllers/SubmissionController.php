<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSubmissionRequest;
use App\Http\Requests\UpdateSubmissionRequest;
use App\Models\Contestant;
use App\Models\Destination;
use App\Models\Submission;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Contestant $contestant)
    {
        return Inertia::render('submissions.index', [
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
        return Inertia::render('submissions.create', [
            'contestant' => $contestant
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateSubmissionRequest $request, Contestant $contestant)
    {
        $destination = Destination::findOrfail($request->input('destination'));

        $submission = new Submission($request->validated());
        $submission->destination()->associate($destination);
        $submission->contestant()->associate($contestant);

        if ($request->hasFile('image')) {
            $submission->storeImage($request->file('image'));
        }

        $submission->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Submission $submission)
    {
        return Inertia::render('submissions.show', [
            'submission' => $submission
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Submission $submission)
    {
        return Inertia::render('submissions.edit', [
            'submission' => $submission
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubmissionRequest $request, Submission $submission)
    {
        $submission->update($request->validated());

        if ($request->input('destination') !== $submission->destination_id) {
            $destination = Destination::findOrfail($request->input('destination'));
            $submission->destination()->associate($destination);
        }

        if ($request->hasFile('image')) {
            $submission->storeImage($request->file('image'));
        }

        $submission->save();

        return redirect()->back();
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
