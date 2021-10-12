<?php

namespace App\Http\Controllers;

use App\Http\Requests\CandidatesRequest;
use Illuminate\Http\Request;
use App\Notifications\CandidateCreated;
use App\Candidate;

class CandidatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('candidates.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('candidates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CandidatesRequest $request)
    {
        $validated = $request->validated();
        $validated['interests'] = implode(',', $validated['interests']);
        $candidate = Candidate::create($validated);
        $candidate->notify(new CandidateCreated());
        return response()->json(['success'=>'yes']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Candidate $candidate)
    {
        return view('candidates.show', compact('candidate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Candidate $candidate)
    {
        return view('candidates.edit', compact('candidate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CandidatesRequest $request, $id)
    {
        $validated = $request->validated();
        $validated['interests'] = implode(',', $validated['interests']);
        $candidate = Candidate::find($id);
        $candidate->update($validated);
        return response()->json(['success'=>'yes']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $candidate = Candidate::find($id);
        $candidate->delete();
        session()->flash('success', __('global.record_deleted'));
        return redirect()->back();
    }
}
