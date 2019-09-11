@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Evaluator {{$evaluator->user->name}} Dashboard</h1>
        <div class="row">
            @foreach($challenges as $challenge)
                <div class="col-md-4 my-2">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">{{$challenge->name}} Challenge</h5>
                            <p class="card-text">Active?: @if($challenge->active) Yes @else No @endif</p>
                            <p class="card-text">Start date: {{date("m/d/Y", strtotime($challenge->start_date))}}</p>
                            <p class="card-text">End date: {{date("m/d/Y", strtotime($challenge->end_date))}}</p>
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