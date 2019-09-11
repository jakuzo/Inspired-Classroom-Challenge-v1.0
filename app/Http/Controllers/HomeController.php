<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $auth_user = Auth::user();

        $user = User::where('id', $auth_user->getAuthIdentifier())->first();

        if($user->userType() == 'administrator'){
            return redirect()->route('administrators.dashboard', $user->userTypeModel());
        }

        if($user->userType() == 'evaluator'){
            return redirect()->route('evaluators.dashboard', $user->userTypeModel());
        }

        if($user->userType() == 'student'){
            return redirect()->route('students.dashboard', $user->userTypeModel());
        }

        if($user->userType() == 'teacher'){
            return redirect()->route('teachers.dashboard', $user->userTypeModel());
        }

        //return view('home');
    }
}
