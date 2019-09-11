<?php

namespace App\Http\Controllers;

use App\Challenge;
use App\Step;
use Illuminate\Http\Request;

class StepController extends Controller
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
    public function create(Request $request)
    {
        $challenge = Challenge::first();
        $data = [
            'challenge' => $challenge
        ];
        return view('administrators.CreateChallengeSteps', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Challenge $challenge)
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
        $step->teacher_id = 0;
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

        return redirect(route('challenges.create_steps', ['challenge'=>$challenge]));
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


    /**
     * Display the specified resource.
     *
     * @param  \App\Step  $step
     * @return \Illuminate\Http\Response
     */
    public function show(Step $step)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Step  $step
     * @return \Illuminate\Http\Response
     */
    public function edit(Step $step)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Step  $step
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Step $step)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Step  $step
     * @return \Illuminate\Http\Response
     */
    public function destroy(Step $step)
    {
        //
    }

    public function fetch_info(Step $step)
    {
        $data = [
            'step_name' => $step->name,
            'step_num' => $step->number,
            'step_text' => $step->text,
            'step_resource_name' => $step->resources_name,
            'step_resource_text' => $step->resources_text,
            'step_reminder' => $step->resources_reminders,
        ];
        return ($data);
    }

    public function fetch_all(Step $step)
    {
        $all_challenges = Challenge::get();
        return ($all_challenges);
    }
}
