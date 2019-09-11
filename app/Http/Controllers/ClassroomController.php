<?php

namespace App\Http\Controllers;

use App\Challenge;
use App\Classroom;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClassroomController extends Controller
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
        $challenges = Challenge::where('active', true)->orderBy('id')->pluck('name', 'id');
        return view('CreateClass', compact('challenges'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'start_date',
            'end_date',
            'num_students',
            'num_teams',

            //TODO: change to challenge_id
            'challenge'
        ]);

        function generateCode($length = 8){
            $str = '';
            $characters = array_merge(range('A','Z'), range('0','9'));
            $max = count($characters) - 1;
            
	        for ($i = 0; $i < $length; $i++) {
		        $rand = mt_rand(0, $max);
		        $str .= $characters[$rand];
	        }
	        return $str;
        }

        //creates a new classroom object
        $classroom = new Classroom;

        //stores theinformation from the fields that the user entered
        $classroom->name = $request->input('name');
        $classroom->start_date = $request->input('start_date');
        $classroom->end_date = $request->input('end_date');
        $classroom->num_students = $request->input('num_students');
        $classroom->num_teams = $request->input('num_teams');
        //TODO: change to challenge_id
        $classroom->challenge_id = $request->input('challenge');

        //Laravel dynamically can retain the teacher's id by detecting who is logged in
        $classroom->teacher_id = Auth::user()->userTypeModel()->id;

        //Making code it's own variable so that it can be passed with the redirect
        $code = generateCode();
        $classroom->join_code = $code;
        
        $classroom->save();

        $user_type_model = \Illuminate\Support\Facades\Auth::user()->userTypeModel();
        return redirect(route('teachers.dashboard', ['teacher'=>$user_type_model]));
        //return redirect()->route('home')->with('status', $code);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom)
    {
        //checks and then retrieves the classroom associated with the teacher logged in
        /*if(Classroom::where('id', $classroom->id)->exists()) {
            $class = Classroom::where('id', $classroom->id)->get()->first();
        }*/
      

        $class_data = [
            'teacher' => $classroom->teacher,
            'classroom' => $classroom,
            'teams' => $classroom->teams,
            'students' => $classroom->students
        ];
        
        return view('ClassDisplay', $class_data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit(Classroom $classroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classroom $classroom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classroom $classroom)
    {
        //
    }
}
