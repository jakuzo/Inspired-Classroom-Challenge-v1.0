<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display the specified resource dashboard.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function dashboard(Student $student)
    {
        $data = [
            'student' => $student,
            'classrooms' => $student->classrooms
        ];
        return view('students.dashboard', $data);
    }

    /**
     * Display the specified resource user guide.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function userGuide(Student $student)
    {
        $data = [
            'student' => $student,
            'classrooms' => $student->classrooms
        ];
        return view('students.userGuide', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        return view('students.index')->with('students', $students);
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
        $student = new Student([
            'user_id' => Auth::id()
        ]);
        $student->save();

        return redirect()->back()->with('status', 'Student created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        $student_data = [
            'student_name' => $student->name,
            'student_id'=> $student->id,
            'student' => $student,
            'classrooms' => $student->classrooms
        ];

        return view('students.dashboard', $student_data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->back();
    }

    public function joinClass(Request $request, Student $student)
    {
        $request->validate([
            'join_code' => 'required',
        ]);

        $join_code = $request->input('join_code');

        $classroom = Classroom::where('join_code', $join_code)->first();
        $student->classrooms()->attach($classroom);
        return redirect()->route('students.dashboard', ['student'=>$student]);
    }

    public function viewChallenge(){
        return view('challenges.challenge_by_team');
    }
}
