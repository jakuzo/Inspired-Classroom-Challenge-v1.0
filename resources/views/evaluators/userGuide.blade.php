@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Evaluator {{$evaluator->user->name}} Dashboard</h1>
        <div class="row">
            @foreach($challenges as $challenge)
                <div class="col-md-4 my-2">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Challenge: {{$challenge->name}}</h5>
                            <h5 class="card-title">Active?: @if($challenge->active) Yes @else No @endif</h5>
                            <h5 class="card-title">Start date: {{date("m/d/Y", strtotime($challenge->start_date))}}</h5>
                            <h5 class="card-title">End date: {{date("m/d/Y", strtotime($challenge->end_date))}}</h5>
                            <a href="{{route('challenges.feedback', ['challenge' => $challenge])}}"
                               class="btn btn-primary">
                                Review Answers
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection