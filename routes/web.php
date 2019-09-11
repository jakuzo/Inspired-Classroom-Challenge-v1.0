<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {


    Route::get('class_display', 'ClassroomController@show')->name('ClassDisplay');
    Route::get('create_class', 'ClassroomController@create');

    /*Route::resources([
        'administrators' => 'AdministratorController',
        'challenges' => 'ChallengeController',
        'classrooms' => 'ClassroomController',
        'evaluators' => 'EvaluatorController',
        'schools' => 'SchoolController',
        'states' => 'StateController',
        'steps' => 'StepController',
        'students' => 'StudentController',
        'teachers' => 'TeacherController',
        'teams' => 'TeamController',
        'users' => 'UserController',
        'zipcodes' => 'ZipcodeController'
    ]);*/

    Route::get('administrators', 'AdministratorController@index')->name('administrators.index');
    Route::get('administrators/create', 'AdministratorController@create')->name('administrators.create');
    Route::post('administrators/create', 'AdministratorController@store')->name('administrators.store');
    Route::get('administrators/createChallenge', 'AdministratorController@createChallenge')->name('administrators.createChallenge');


    Route::middleware(['administrator'])->group(function () {
        Route::get('administrators/{administrator}/show', 'AdministratorController@show')->name('administrators.show');
        Route::get('administrators/{administrator}/dashboard', 'AdministratorController@dashboard')->name('administrators.dashboard');
        Route::get('administrators/{administrator}/userGuide', 'AdministratorController@userGuide')->name('administrators.userGuide');
        Route::get('administrators/{administrator}/edit', 'AdministratorController@edit')->name('administrators.edit');
        Route::post('administrators/{administrator}/edit', 'AdministratorController@update')->name('administrators.update');
        Route::get('administrators/{administrator}/destroy', 'AdministratorController@destroy')->name('administrators.destroy');
        Route::get('administrators/{administrator}/users', 'AdministratorController@index_users')->name('administrators.index_users');
    });

    Route::any('/search', 'AdministratorController@search')->name('administrators.search');

    Route::get('answers', 'AnswerController@index')->name('answers.index');
    Route::get('answers/create', 'AnswerController@create')->name('answers.create');
    Route::post('answers/create', 'AnswerController@store')->name('answers.store');
    Route::get('answers/{answer}/show', 'AnswerController@show')->name('answers.show');
    Route::get('answers/{answer}/edit', 'AnswerController@edit')->name('answers.edit');
    Route::post('answers/{answer}/edit', 'AnswerController@update')->name('answers.update');
    Route::get('answers/{answer}/destroy', 'AnswerController@destroy')->name('answers.destroy');

    Route::get('challenges', 'ChallengeController@index')->name('challenges.index');
    Route::get('challenges/create', 'ChallengeController@create')->name('challenges.create');
    Route::post('challenges/create', 'ChallengeController@store')->name('challenges.store');
    Route::get('challenges/{challenge}/show', 'ChallengeController@show')->name('challenges.show');
    Route::get('challenges/{challenge}/edit', 'ChallengeController@edit')->name('challenges.edit');
    Route::post('challenges/{challenge}/edit', 'ChallengeController@update')->name('challenges.update');
    Route::get('challenges/{challenge}/destroy', 'ChallengeController@destroy')->name('challenges.destroy');
    Route::get('challenges/{challenge}/feedback', 'ChallengeController@feedback')->name('challenges.feedback');
    Route::get('challenges/{challenge}/steps', 'ChallengeController@create_steps')->name('challenges.create_steps');
    Route::post('challenges/{challenge}/steps', 'ChallengeController@store_step')->name('challenges.store_step');
    Route::get('challenges/{challenge}/steps/{step}', 'ChallengeController@edit_step')->name('challenges.edit_step');
    Route::get('challenges/manage', 'ChallengeController@manage')->name('challenges.manage');
    Route::get('challenges/{challenge}/overview', 'ChallengeController@view_challenge')->name('challenges.view_challenge');
    Route::get('challenges/{challenge}/{school}/overview', 'ChallengeController@view_school')->name('challenges.view_school');
    Route::get('challenges/{challenge}/edit', 'ChallengeController@edit_challenge')->name('challenges.edit_challenge');
    Route::post('challenges/{challenge}/steps/{step}', 'ChallengeController@update_step')->name('challenges.update_step');
    Route::get('challenges/{challenge}/post', 'ChallengeController@make_active')->name('challenges.make_active');
    Route::get('challenges/progress', 'ChallengeController@get_progress_all')->name('challenges.get_progress_all');

    Route::get('classrooms', 'ClassroomController@index')->name('classrooms.index');
    Route::get('classrooms/create', 'ClassroomController@create')->name('classrooms.create');
    Route::post('classrooms/create', 'ClassroomController@store')->name('classrooms.store');
    Route::get('classrooms/{classroom}/show', 'ClassroomController@show')->name('classrooms.show');
    Route::get('classrooms/{classroom}/edit', 'ClassroomController@edit')->name('classrooms.edit');
    Route::post('classrooms/{classroom}/edit', 'ClassroomController@update')->name('classrooms.update');
    Route::get('classrooms/{classroom}/destroy', 'ClassroomController@destroy')->name('classrooms.destroy');

    Route::get('evaluators', 'EvaluatorController@index')->name('evaluators.index');
    Route::get('evaluators/create', 'EvaluatorController@create')->name('evaluators.create');
    Route::post('evaluators/create', 'EvaluatorController@store')->name('evaluators.store');

    Route::middleware(['evaluator'])->group(function () {
        Route::get('evaluators/{evaluator}/show', 'EvaluatorController@show')->name('evaluators.show');
        Route::get('evaluators/{evaluator}/dashboard', 'EvaluatorController@dashboard')->name('evaluators.dashboard');
        Route::get('evaluators/{evaluator}/userGuide', 'EvaluatorController@userGuide')->name('evaluators.userGuide');
        Route::get('evaluators/{evaluator}/edit', 'EvaluatorController@edit')->name('evaluators.edit');
        Route::post('evaluators/{evaluator}/edit', 'EvaluatorController@update')->name('evaluators.update');
        Route::get('evaluators/{evaluator}/destroy', 'EvaluatorController@destroy')->name('evaluators.destroy');
    });

    Route::get('schools', 'SchoolController@index')->name('schools.index');
    Route::get('schools/create', 'SchoolController@create')->name('schools.create');
    Route::post('schools/create', 'SchoolController@store')->name('schools.store');
    Route::get('schools/{school}/show', 'SchoolController@show')->name('schools.show');
    Route::get('schools/{school}/edit', 'SchoolController@edit')->name('schools.edit');
    Route::post('schools/{school}/edit', 'SchoolController@update')->name('schools.update');
    Route::get('schools/{school}/destroy', 'SchoolController@destroy')->name('schools.destroy');

    Route::get('states', 'StateController@index')->name('states.index');
    Route::get('states/create', 'StateController@create')->name('states.create');
    Route::post('states/create', 'StateController@store')->name('states.store');
    Route::get('states/{state}/show', 'StateController@show')->name('states.show');
    Route::get('states/{state}/edit', 'StateController@edit')->name('states.edit');
    Route::post('states/{state}/edit', 'StateController@update')->name('states.update');
    Route::get('states/{state}/destroy', 'StateController@destroy')->name('states.destroy');

    Route::get('steps', 'StepController@index')->name('steps.index');
    Route::get('steps/create', 'StepController@create')->name('steps.create');
    Route::post('steps/create', 'StepController@store')->name('steps.store');
    Route::get('steps/{step}/show', 'StepController@show')->name('steps.show');
    Route::get('steps/{step}/edit', 'StepController@edit')->name('steps.edit');
    Route::post('steps/{step}/edit', 'StepController@update')->name('steps.update');
    Route::get('steps/{step}/destroy', 'StepController@destroy')->name('steps.destroy');

    Route::get('students', 'StudentController@index')->name('students.index');
    Route::get('students/create', 'StudentController@create')->name('students.create');
    Route::post('students/create', 'StudentController@store')->name('students.store');

    Route::middleware(['student'])->group(function () {
        Route::get('students/{student}/show', 'StudentController@show')->name('students.show');
        Route::get('students/{student}/dashboard', 'StudentController@dashboard')->name('students.dashboard');
        Route::get('students/{student}/userGuide', 'StudentController@userGuide')->name('students.userGuide');
        Route::post('students/{student}/joinClass', 'StudentController@joinClass')->name('students.joinClass');
        Route::get('students/{student}/edit', 'StudentController@edit')->name('students.edit');
        Route::post('students/{student}/edit', 'StudentController@update')->name('students.update');
        Route::get('students/{student}/destroy', 'StudentController@destroy')->name('students.destroy');
        Route::get('students/{student}/viewChallenge', 'StudentController@viewChallenge')->name('students.viewChallenge');
    });

    Route::get('teachers', 'TeacherController@index')->name('teachers.index');
    Route::get('teachers/create', 'TeacherController@create')->name('teachers.create');
    Route::post('teachers/create', 'TeacherController@store')->name('teachers.store');

    Route::middleware(['teacher'])->group(function () {
        Route::get('teachers/{teacher}/show', 'TeacherController@show')->name('teachers.show');
        Route::get('teachers/{teacher}/dashboard', 'TeacherController@dashboard')->name('teachers.dashboard');
        Route::get('teachers/{teacher}/userGuide', 'TeacherController@userGuide')->name('teachers.userGuide');
        Route::get('teachers/{teacher}/edit', 'TeacherController@edit')->name('teachers.edit');
        Route::post('teachers/{teacher}/edit', 'TeacherController@update')->name('teachers.update');
        Route::get('teachers/{teacher}/destroy', 'TeacherController@destroy')->name('teachers.destroy');
    });

    Route::get('teams', 'TeamController@index')->name('teams.index');
    Route::get('teams/create', 'TeamController@create')->name('teams.create');
    Route::post('teams/create', 'TeamController@store')->name('teams.store');
    Route::get('teams/{team}/show', 'TeamController@show')->name('teams.show');
    Route::get('teams/{team}/edit', 'TeamController@edit')->name('teams.edit');
    Route::post('teams/{team}/edit', 'TeamController@update')->name('teams.update');
    Route::get('teams/{team}/destroy', 'TeamController@destroy')->name('teams.destroy');

    Route::post('teams/{team}/addStudent', 'TeamController@addStudent')->name('teams.addStudent');
    Route::get('teams/{team}/removeStudent/{student}', 'TeamController@removeStudent')->name('teams.removeStudent');
    // TO DO: pass the team parameter with the route in order to display the view corresponding to the team 
    Route::get('teams/viewChallenge', 'TeamController@viewChallenge')->name('teams.viewChallenge');

    Route::get('users', 'UserController@index')->name('users.index');
    Route::get('users/create', 'UserController@create')->name('users.create');
    Route::post('users/create', 'UserController@store')->name('users.store');
    Route::get('users/{user}/show', 'UserController@show')->name('users.show');
    Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit');
    Route::post('users/{user}/edit', 'UserController@update')->name('users.update');
    Route::get('users/{user}/destroy', 'UserController@destroy')->name('users.destroy');
    Route::get('users/{user}/dashboard', 'UserController@dashboard')->name('users.dashboard');

    Route::get('zipcodes', 'ZipcodeController@index')->name('zipcodes.index');
    Route::get('zipcodes/create', 'ZipcodeController@create')->name('zipcodes.create');
    Route::post('zipcodes/create', 'ZipcodeController@store')->name('zipcodes.store');
    Route::get('zipcodes/{zipcode}/show', 'ZipcodeController@show')->name('zipcodes.show');
    Route::get('zipcodes/{zipcode}/edit', 'ZipcodeController@edit')->name('zipcodes.edit');
    Route::post('zipcodes/{zipcode}/edit', 'ZipcodeController@update')->name('zipcodes.update');
    Route::get('zipcodes/{zipcode}/destroy', 'ZipcodeController@destroy')->name('zipcodes.destroy');

    Route::get('feedback/{feedback}/edit', 'FeedbackController@edit')->name('feedback.edit');
    Route::post('feedback/{feedback}/edit', 'FeedbackController@update')->name('feedback.update');

//summernote form
    Route::view('/summernote', 'summernote');
//summernote store route
    Route::post('/summernote', 'SummernoteController@store')->name('summernotePersist');
//summernote display route
    Route::get('/summernote_display', 'SummernoteController@show')->name('summernoteDisplay');
    Route::get('files/create', 'FileController@create')->name('files.create');
    Route::post('files/create', 'FileController@store')->name('files.store');


});