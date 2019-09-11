<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Challenge;
use App\Feedback;
use App\Step;
use App\Teacher;
use App\Classroom;
use App\School;
use App\Administrator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChallengeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_challenges = Challenge::get();
        return ($all_challenges);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrators.CreateChallenge');
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
            'name' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'simulationinput' => 'required|string',
            'resourcesinput' => 'required|string',
        ]);

        $challenge = new Challenge();
        $challenge->name = $request->input('name');
        $challenge->start_date = $request->input('start_date');
        $challenge->end_date = $request->input('end_date');
        $challenge->active = 0;

        $detail=$request->input('backgroundinput');
        $dom = new \domdocument();
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        /*$images = $dom->getelementsbytagname('img');
        foreach($images as $k => $img){
            $data = $img->getattribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            $image_name= time().$k.'.png';
            $path = public_path() .'/'. $image_name;
            file_put_contents($path, $data);
            $img->removeattribute('src');
            $img->setattribute('src', $image_name);
        }*/
        $detail = $dom->savehtml();
        $challenge->background = $detail;

        $detail=$request->input('simulationinput');
        $dom = new \domdocument();
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        /*$images = $dom->getelementsbytagname('img');
        foreach($images as $k => $img){
            $data = $img->getattribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            $image_name= time().$k.'.png';
            $path = public_path() .'/'. $image_name;
            file_put_contents($path, $data);
            $img->removeattribute('src');
            $img->setattribute('src', $image_name);
        }*/
        $detail = $dom->savehtml();
        $challenge->scenario = $detail;

        $detail=$request->input('resourcesinput');
        $dom = new \domdocument();
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        /*$images = $dom->getelementsbytagname('img');
        foreach($images as $k => $img){
            $data = $img->getattribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            $image_name= time().$k.'.png';
            $path = public_path() .'/'. $image_name;
            file_put_contents($path, $data);
            $img->removeattribute('src');
            $img->setattribute('src', $image_name);
        }*/
        $detail = $dom->savehtml();
        $challenge->research = $detail;
        $challenge->save();

        return redirect(route('challenges.create_steps', ['challenge'=>$challenge]));
    }

    public function make_active(Challenge $challenge)
    {
        $challenge->active = 1;
        //$user_id = Auth::id();
        // if(Administrator::where('user_id', $user_id)->exists()) {
        //    $admin = Administrator::where('user_id', $user_id)->get()->first();
        // }
        $challenge->save();
        return redirect(route('challenges.manage'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Challenge  $challenge
     * @return \Illuminate\Http\Response
     */
    public function show(Challenge $challenge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Challenge  $challenge
     * @return \Illuminate\Http\Response
     */
    public function edit(Challenge $challenge)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Challenge  $challenge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Challenge $challenge)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Challenge  $challenge
     * @return \Illuminate\Http\Response
     */
    public function destroy(Challenge $challenge)
    {
        //
    }


    public function feedback(Challenge $challenge)
    {
        $evaluator = Auth::user()->userTypeModel();
        $feedback = Feedback::where('evaluator_id', $evaluator->id)->get();

        $feedback_collection = collect();
        foreach ($feedback as $item) {
            if ($item->answer->step->challenge_id == $challenge->id) {
                $feedback_collection->push($item);
            }
        }

        $data = [
            'evaluator' => $evaluator,
            'challenge' => $challenge,
            'feedback' => $feedback_collection->sortByDesc('updated_at')
        ];

        return view('challenges.feedback', $data);
    }

    public function manage()
    {
        $all_challenges = Challenge::get();
        return view('challenges.challenge_management')->with('all_challenges', $all_challenges);
    }

    public function edit_challenge(Challenge $challenge)
    {
        if(Step::where('challenge_id', $challenge->id)->exists()){
            $steps = Step::where('challenge_id', $challenge->id)->get();
            $steps_collection = collect();
            foreach ($steps as $item) {
                if ($item->challenge_id == $challenge->id) {
                    $steps_collection->push($item);
                }
            }
        }
        else{
            $steps_collection = collect([]);
        }
        $steps_sorted = $steps_collection->sortBy('step_number');

        $data = [
            'challenge' => $challenge,
            'steps' => $steps_sorted
        ];
        return view('challenges.edit_challenge', $data);
    }

    public function view_challenge(Challenge $challenge)
    {
        if(Classroom::where('challenge_id', $challenge->id)->exists()){
            $class = Classroom::where('challenge_id', $challenge->id)->get();
            $classes = collect();
            $teacher_ids = collect();
            $teachers = collect();
            $school_ids = collect();
            $schools = collect();
            foreach ($class as $item) {
                if ($item->challenge_id == $challenge->id) {
                    $classes->push($item);
                    $teacher_ids->push($item->teacher_id);
                }
            }
            $teachers_unique = $teacher_ids->unique();
            foreach ($teachers_unique as $teach) {
                $teacher = Teacher::where('id', $teach)->get();
                foreach ($teacher as $teach) {
                    $teachers->push($teach);
                    $school_ids->push($teach->school_id);

                }
            }
            $schools_unique = $school_ids->unique();
            foreach ($schools_unique as $item) {
                $school = School::where('id', $item)->get();
                foreach ($school as $item) {
                    $schools->push($item);
                }
            }
        }

        else{
            $classes = collect([]);
            $teachers = collect([]);
            $schools = collect([]);
        }
        $data = [
            'challenge' => $challenge,
            'classes' => $classes,
            'teachers' => $teachers,
            'schools' => $schools,
        ];
        return view('challenges.overview', $data);
    }

    public function create_steps(Request $request, Challenge $challenge)
    {
        if(Step::where('challenge_id', $challenge->id)->exists()){
            $steps = Step::where('challenge_id', $challenge->id)->get();
            $steps_collection = collect();
            foreach ($steps as $item) {
                if ($item->challenge_id == $challenge->id) {
                    $steps_collection->push($item);
                }
            }
        }
        else{
            $steps_collection = collect([]);
        }

        $data = [
            'challenge' => $challenge,
            'steps' => $steps_collection
        ];
        return view('administrators.CreateChallengeSteps', $data);
    }


    public function edit_step(Challenge $challenge, Step $step)
    {
        if(Step::where('challenge_id', $challenge->id)->exists()){
            $steps = Step::where('challenge_id', $challenge->id)->get();
            $steps_collection = collect();
            foreach ($steps as $item) {
                if ($item->challenge_id == $challenge->id) {
                    if ($item->id != $step->id) {
                        $steps_collection->push($item);
                    }
                }
            }
        }
        else{
            $steps_collection = collect([]);
        }

        $data = [
            'challenge' => $challenge,
            'target_step' => $step,
            'steps' => $steps_collection
        ];
        return view('challenges.edit_step', $data);
    }

    public function update_step(Request $request, Step $step, Challenge $challenge)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'stepinput' => 'required|string',
            'resource_name' => 'required|string',
            'resourcesinput' => 'required|string',
            'remindersinput' => 'required|string',
        ]);

        $step->name = $request->input('name');
        //$step->step_number = $number;    Still need to make it possible for them to set the step number
        $step->resources_name = $request->input('resource_name');

        $detail=$request->stepinput;
        $dom = new \domdocument();
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getelementsbytagname('img');
        /*foreach($images as $k => $img){
            $data = $img->getattribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            $image_name= time().$k.'.png';
            $path = public_path() .'/'. $image_name;
            file_put_contents($path, $data);
            $img->removeattribute('src');
            $img->setattribute('src', $image_name);
        }*/
        $detail = $dom->savehtml();
        $step->text = $detail;


        $detail=$request->resourcesinput;
        $dom = new \domdocument();
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getelementsbytagname('img');
        /*foreach($images as $k => $img){
            $data = $img->getattribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            $image_name= time().$k.'.png';
            $path = public_path() .'/'. $image_name;
            file_put_contents($path, $data);
            $img->removeattribute('src');
            $img->setattribute('src', $image_name);
        }*/
        $detail = $dom->savehtml();
        $step->resources_text = $detail;

        $detail=$request->remindersinput;
        $dom = new \domdocument();
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getelementsbytagname('img');
        /*foreach($images as $k => $img){
            $data = $img->getattribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            $image_name= time().$k.'.png';
            $path = public_path() .'/'. $image_name;
            file_put_contents($path, $data);
            $img->removeattribute('src');
            $img->setattribute('src', $image_name);
        }*/
        $detail = $dom->savehtml();
        $step->resources_reminders = $detail;

        $step->save();

        if(Step::where('challenge_id', $challenge->id)->exists()){
            $steps = Step::where('challenge_id', $challenge->id)->get();
            $steps_collection = collect();
            foreach ($steps as $item) {
                if ($item->challenge_id == $challenge->id) {
                    $steps_collection->push($item);
                }
            }
        }
        else{
            $steps_collection = collect([]);
        }

        $data = [
            'challenge' => $challenge,
            'steps' => $steps_collection
        ];
        return view('administrators.CreateChallengeSteps', $data);


    }


    public function store_step(Request $request, Challenge $challenge)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'stepinput' => 'required|string',
            'resource_name' => 'required|string',
            'resourcesinput' => 'required|string',
            'remindersinput' => 'required|string',
        ]);

        $number = Step::where('challenge_id', $challenge->id)->count();
        $number++;

        $step = new Step();
        $step->challenge_id = $challenge->id;
        $step->name = $request->input('name');
        $step->step_number = $number;
        $step->resources_name = $request->input('resource_name');

        $detail=$request->stepinput;
        $dom = new \domdocument();
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getelementsbytagname('img');
        /*foreach($images as $k => $img){
            $data = $img->getattribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            $image_name= time().$k.'.png';
            $path = public_path() .'/'. $image_name;
            file_put_contents($path, $data);
            $img->removeattribute('src');
            $img->setattribute('src', $image_name);
        }*/
        $detail = $dom->savehtml();
        $step->text = $detail;


        $detail=$request->resourcesinput;
        $dom = new \domdocument();
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getelementsbytagname('img');
        /*foreach($images as $k => $img){
            $data = $img->getattribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            $image_name= time().$k.'.png';
            $path = public_path() .'/'. $image_name;
            file_put_contents($path, $data);
            $img->removeattribute('src');
            $img->setattribute('src', $image_name);
        }*/
        $detail = $dom->savehtml();
        $step->resources_text = $detail;

        $detail=$request->remindersinput;
        $dom = new \domdocument();
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getelementsbytagname('img');
        /*foreach($images as $k => $img){
            $data = $img->getattribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            $image_name= time().$k.'.png';
            $path = public_path() .'/'. $image_name;
            file_put_contents($path, $data);
            $img->removeattribute('src');
            $img->setattribute('src', $image_name);
        }*/
        $detail = $dom->savehtml();
        $step->resources_reminders = $detail;

        $step->save();

        if(Step::where('challenge_id', $challenge->id)->exists()){
            $steps = Step::where('challenge_id', $challenge->id)->get();
            $steps_collection = collect();
            foreach ($steps as $item) {
                if ($item->challenge_id == $challenge->id) {
                    $steps_collection->push($item);
                }
            }
        }
        else{
            $steps_collection = collect([]);
        }

        $data = [
            'challenge' => $challenge,
            'steps' => $steps_collection
        ];
        return view('administrators.CreateChallengeSteps', $data);
    }

    public function fetch_all()
    {
        $all_challenges = Challenge::get();
        return ($all_challenges);
    }


    public function view_school(Challenge $challenge, School $school)
    {
        if(Classroom::where('challenge_id', $challenge->id)->exists()) {
            $class = Classroom::where('challenge_id', $challenge->id)->get();
            $classes = collect();
            $teacher_ids = collect();
            $teachers = collect();
            $school_classes = collect();
            foreach ($class as $item) {
                if ($item->challenge_id == $challenge->id) {
                    $classes->push($item);
                    $teacher_ids->push($item->teacher_id);
                }
            }
            $teachers_unique = $teacher_ids->unique();
            foreach ($teachers_unique as $item) {
                $teacher = Teacher::where('id', $item)->get();
                foreach ($teacher as $item) {
                    if ($item->school_id == $school->id) {
                        $teachers->push($item);
                        $teacher_ids->push($item);
                    }
                }
            }

            foreach ($teachers as $teacher){
                $class = Classroom::where('teacher_id', $teacher->id)->get();
                foreach ($class as $item) {
                    if ($item->challenge_id == $challenge->id) {
                        $school_classes->push($item);
                    }
                }
            }

        }

        else{
            $school_classes = collect([]);
            $teachers = collect([]);
        }
        $data = [
            'challenge' => $challenge,
            'classes' => $school_classes,
            'teachers' => $teachers,
            'school' => $school
        ];
        return view('challenges.school_overview', $data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function get_progress(Challenge $challenge)
    {
        ini_set("precision", 3);
        /*$totals = collect();
        $steps = Step::where('challenge_id', $challenge->id)->get();
        if(Classroom::where('challenge_id', $challenge->id)->exists()) {
            $class = Classroom::where('challenge_id', $challenge->id)->get();
            foreach ($class as $item) {
                if(Answer::where('classroom_id', $item->id)->exists()) {
                    $answers = Answer::where('classroom_id', $item->id)->get();
                    $tot = count($answers);
                    $done = 0;
                    foreach ($steps as $step) {
                        foreach ($answers as $answer) {
                            if ($answer->ready == 1 && $answer->step_id == $step->step_number) {
                                $done++;
                            }
                        }
                        $ratio = $done/$tot;
                        $totals->push($ratio);
                    }
                    dd($totals);
                }
            }
        }

        else{

        }

        return $totals;*/
    }

    public function get_progress_all()
    {
        ini_set("precision", 3);
        $all_challenges = Challenge::get();
        $stats = collect();
        foreach($all_challenges as $challenge){
            ${"totals" . $challenge->id} = collect();
            $steps = Step::where('challenge_id', $challenge->id)->get();
            if(Classroom::where('challenge_id', $challenge->id)->exists()) {
                $class = Classroom::where('challenge_id', $challenge->id)->get();
                foreach ($class as $item) {
                    if(Answer::where('classroom_id', $item->id)->exists()) {
                        $answers = Answer::where('classroom_id', $item->id)->get();
                        $tot = count($answers);
                        $done = 0;
                        foreach ($steps as $step) {
                            foreach ($answers as $answer) {
                                if ($answer->ready == 1 && $answer->step_id == $step->step_number) {
                                    $done++;
                                }
                            }
                            $ratio = $done/$tot;
                            ${"totals" . $challenge->id}->push($ratio);
                            //${"totals" . $challenge->id}->put($step->step_number, $ratio);
                        }
                    }

                }

            }
           // $stats->push(${"totals" . $challenge->id});
         if(${"totals" . $challenge->id}->isNotEmpty()){
             $stats->push(${"totals" . $challenge->id});
         }

        }
        //dd($stats);
        $data = [
            'stats' => $stats
        ];

        return view('challenges.progress', $data);
    }


}
