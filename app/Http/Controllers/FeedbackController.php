<?php

namespace App\Http\Controllers;

use App\Feedback;
use App\File;
use Illuminate\Http\Request;

class FeedbackController extends Controller
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
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function show(Feedback $feedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function edit(Feedback $feedback)
    {
        $data = [
            'feedback' => $feedback
        ];
        return view('feedback.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feedback $feedback)
    {
        $request->validate([
            'text' => 'required|string',
            'grade' => 'required|integer|between:0,4',
            'user_file' => 'nullable|file',
            'ready' => 'nullable'
        ]);

        $feedback->text = $request->input('text');
        $feedback->grade = $request->input('grade');

        $ready = $request->input('ready');
        if ($ready !== null and $ready == "yes") {
            $feedback->ready = true;
        } else {
            $feedback->ready = false;
        }

        $feedback->save();

        $uploaded_file = $request->file('user_file');
        if ($uploaded_file) {
            $search_file = $uploaded_file->store('public');
            $search_file = str_replace("public/", "", $search_file);

            $file = new File();
            $file->name = $search_file;
            $file->size = $uploaded_file->getClientSize();
            $file->type = $uploaded_file->getClientMimeType();
            $feedback->files()->save($file);
        }

        $request->session()->flash('alert-success', 'Successfully edited the feedback!');
        return redirect()->route('challenges.feedback', ['challenge' => $feedback->answer->step->challenge]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feedback $feedback)
    {
        //
    }
}
