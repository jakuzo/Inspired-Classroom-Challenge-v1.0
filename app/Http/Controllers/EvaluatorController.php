<?php

namespace App\Http\Controllers;

use App\Evaluator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluatorController extends Controller
{
    /**
     * Display the specified resource dashboard.
     *
     * @param  \App\Evaluator  $evaluator
     * @return \Illuminate\Http\Response
     */
    public function dashboard(Evaluator $evaluator)
    {
        $data = [
            'evaluator' => $evaluator,
            'challenges' => $evaluator->challenges->sortByDesc('end_date')
        ];
        return view('evaluators.dashboard', $data);
    }

    /**
     * Display the specified resource user guide.
     *
     * @param  \App\Evaluator  $evaluator
     * @return \Illuminate\Http\Response
     */
    public function userGuide(Evaluator $evaluator)
    {
        $data = [
            'evaluator' => $evaluator,
            'challenges' => $evaluator->challenges
        ];
        return view('evaluators.userGuide', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $evaluators = Evaluator::all();
        return view('evaluators.index')->with('evaluators', $evaluators);
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
        $evaluator = new Evaluator([
            'user_id' => Auth::id()
        ]);
        $evaluator->save();

        return redirect()->back()->with('status', 'Evaluator created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Evaluator  $evaluator
     * @return \Illuminate\Http\Response
     */
    public function show(Evaluator $evaluator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Evaluator  $evaluator
     * @return \Illuminate\Http\Response
     */
    public function edit(Evaluator $evaluator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Evaluator  $evaluator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evaluator $evaluator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Evaluator  $evaluator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evaluator $evaluator)
    {
        $evaluator->delete();

        return redirect()->back();
    }
}
