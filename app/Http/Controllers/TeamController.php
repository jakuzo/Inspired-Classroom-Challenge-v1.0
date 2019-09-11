<?php

namespace App\Http\Controllers;

use App\Student;
use App\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        //
    }

    public function viewChallenge(){

        return view('challenges.challenge_by_team');
    }

    /**Custom function that adds a student to the team */
    public function addStudent(Request $request, Team $team)
    {
        $request->validate([
            'student' => 'required|integer'
        ]);

        $studentId = $request->input('student');
        $team->students()->attach($studentId);

        return redirect()->route('classrooms.show', $team->classroom);
    }

    /**Custom function that adds a student to the team */
    public function removeStudent(Team $team, Student $student)
    {
        $team->students()->detach($student->id);

        return redirect()->route('classrooms.show', $team->classroom);
    }
}
