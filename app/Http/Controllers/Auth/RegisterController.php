<?php

namespace App\Http\Controllers\Auth;

use App\Administrator;
use App\Evaluator;
use App\School;
use App\State;
use App\Student;
use App\Teacher;
use App\User;
use App\Http\Controllers\Controller;
use App\Zipcode;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    // beginning of change for trait RegistersUsers
    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $schools = School::all();
        $zipcodes = Zipcode::all();
        $states = State::all();

        $data = [
            'schools' => $schools,
            'zipcodes' => $zipcodes,
            'states' => $states
        ];

        return view('auth.register', $data);
    }
    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        //event(new Registered($user = $this->create($request->all())));

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        $user_type = $request->input('user_type');
        if ($user_type == 'administrator') {
            Administrator::create([
                'user_id' => $user->id
            ]);
        } else if ($user_type == 'evaluator') {
            Evaluator::create([
                'user_id' => $user->id
            ]);
        } else if ($user_type == 'student') {
            Student::create([
                'user_id' => $user->id
            ]);
        } else if ($user_type == 'teacher') {
            $teacher = Teacher::create([
                'user_id' => $user->id
            ]);


            $school = $request->input('school');
            if ($school == 0) {
                $new_school = new School();
                $new_school->name = $request->input('school_name');
                $new_school->address_line = $request->input('school_address_line');
                $new_school->frlp = $request->input('school_frlp');

                $school_zip = $request->input('school_zip');
                if ($school_zip == 0) {
                    $new_zip_code = new Zipcode();
                    $new_zip_code->zip = $request->input('zip_code');
                    $new_zip_code->state_id = $request->input('zip_state');
                    $new_zip_code->city = $request->input('zip_city');
                    $new_zip_code->save();

                    $new_school->zipcode_id = $new_zip_code->id;
                } else {
                    $new_school->zipcode_id = $school_zip;
                }
                $new_school->save();

                $teacher->school_id = $new_school->id;
            } else {
                $teacher->school_id = $school;
            }
            $teacher->save();
        }


        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
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
    // end of change for trait RegistersUsers


    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'user_type' => ['required', 'string'],
            'school' => ['nullable', 'integer'],
            'school_name' => ['nullable', 'string'],
            'school_address_line' => ['nullable', 'string'],
            'school_frlp' => ['nullable', 'integer'],
            'school_zip' => ['nullable', 'integer'],
            'zip_code' => ['nullable', 'string'],
            'zip_state' => ['nullable', 'integer'],
            'zip_city' => ['nullable', 'string']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
