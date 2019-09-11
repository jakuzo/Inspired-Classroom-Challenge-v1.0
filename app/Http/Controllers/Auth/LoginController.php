<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    // beginning of change for trait AuthenticatesUsers
    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        $user_type = $user->userType();
        $user_type_model = $user->userTypeModel();

        if ($user_type == 'administrator') {
            return redirect(route('administrators.dashboard', ['administrator'=>$user_type_model]));
        } elseif ($user_type == 'evaluator') {
            return redirect(route('evaluators.dashboard', ['evaluator'=>$user_type_model]));
        } elseif ($user_type == 'student') {
            return redirect(route('students.dashboard', ['student'=>$user_type_model]));
        } elseif ($user_type == 'teacher') {
            return redirect(route('teachers.dashboard', ['teacher'=>$user_type_model]));
        } else {
            return redirect()->back();
        }
    }
    // end of change for trait AuthenticatesUsers

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
