<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Http\Requests\StoreApplicantRequest;
use App\Http\Requests\UpdateApplicantRequest;
use Illuminate\Support\Facades\DB;

class ApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('applicants.index', [
            'applicants' => Applicant::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('applicants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreApplicantRequest $request)
    {
        // dd($request);

        // use transaction to save the applicant and related models
        DB::transaction(function () use ($request) {
            $applicant = Applicant::create(
                $request->only('full_name', 'email', 'phone_number')
            );
            $applicant->workExperience()->createMany($request->work_experience);
            $applicant->educationHistory()->createMany($request->education);
            $applicant->skills()->createMany(
                collect($request->skills)->map(function ($skill) {
                    return ['name' => $skill];
                })->toArray()
            );
        });

        return redirect()->route('applicants.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Applicant $applicant)
    {
        return view('applicants.show', compact('applicant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Applicant $applicant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApplicantRequest $request, Applicant $applicant)
    {
        // transaction to update the applicant and related models
        DB::transaction(function () use ($request, $applicant) {
            $applicant->update(
                $request->only('full_name', 'email', 'phone_number')
            );

            // update education history
            foreach ($request->education as $education) {
                $applicant->educationHistory()->updateOrCreate(
                    ['id' => $education['id'] ?? null],
                    $education
                );
            }

            // update work experience
            foreach ($request->work_experience as $experience) {
                $applicant->workExperience()->updateOrCreate(
                    ['id' => $experience['id'] ?? null],
                    $experience
                );
            }

            // update skills
            foreach ($request->skills as $skill) {
                $applicant->skills()->updateOrCreate(
                    ['id' => $skill['id'] ?? null],
                    ['name' => $skill]
                );
            }
        });

        return redirect()->route('applicants.index')->with('success', 'Applicant updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Applicant $applicant)
    {
        $applicant->delete();

        return redirect()->back()->with('success', 'Applicant deleted successfully');
    }
}
