<?php

namespace App\Http\Controllers;

use App\Administrator;
use App\Teacher;
use App\Student;
use App\Evaluator;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdministratorController extends Controller
{
    /**
     * Display the specified resource dashboard.
     *
     * @param  \App\Administrator  $administrator
     * @return \Illuminate\Http\Response
     */
    public function dashboard(Administrator $administrator)
    {
        return view('administrators.dashboard')->with('administrator', $administrator);
    }

    /**
     * Display the specified resource user guide.
     *
     * @param  \App\Administrator  $administrator
     * @return \Illuminate\Http\Response
     */
    public function userGuide(Administrator $administrator)
    {
        return view('administrators.userGuide')->with('administrator', $administrator);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $administrators = Administrator::all();
        return view('administrators.index')->with('administrators', $administrators);
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
        $administrator = new Administrator([
            'user_id' => Auth::id()
        ]);
        $administrator->save();

        return redirect()->back()->with('status', 'Administrator created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Administrator  $administrator
     * @return \Illuminate\Http\Response
     */
    public function show(Administrator $administrator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Administrator  $administrator
     * @return \Illuminate\Http\Response
     */
    public function edit(Administrator $administrator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Administrator  $administrator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Administrator $administrator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Administrator  $administrator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Administrator $administrator)
    {
        $administrator->delete();

        return redirect()->back();
    }

    public function createChallenge()
    {
        return view('administrators.CreateChallenge');
    }

    public function index_users(Administrator $administrator)
    {
        $users = User::all();
        $administrators = collect();
        $teachers = collect();
        $students = collect();
        $evaluators = collect();

        while ($users->isNotEmpty()) {
            $user=$users->pop();
            if(Administrator::where('user_id', $user->id)->exists()){
                $administrators->push($user);
            }
            elseif(Teacher::where('user_id', $user->id)->exists()){
                $teachers->push($user);
            }
            elseif(Student::where('user_id', $user->id)->exists()){
                $students->push($user);
            }
            elseif(Evaluator::where('user_id', $user->id)->exists()){
                $evaluators->push($user);
            }
        }

        $data = [
            'administrator' => $administrator,
            'administrators' => $administrators,
            'students' => $students,
            'teachers' => $teachers,
            'evaluators' => $evaluators
        ];
        return view('administrators.useranalytics', $data);
    }

    public function search(Request $request){
        $q= $request->input('q');
        $user = User::where('name','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->get();
        if(count($user) > 0)
            return view('administrators.user_search')->withDetails($user)->withQuery ( $q );
        else return view ('administrators.user_search')->withMessage('No Details found. Try to search again !');
    }

}
