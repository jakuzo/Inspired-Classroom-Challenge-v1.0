@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Evaluator {{$evaluator->user->name}} review for {{$challenge->name}} Challenge</h1>

        @include('layouts.alerts')

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Question:</h5>
                <p class="card-text">{{strip_tags($feedback->first()->answer->step->text)}}</p>
            </div>
        </div>

        <div class="row">
            @foreach($feedback as $feedback_item)
                <div class="col-md-6 my-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Team {{$feedback_item->answer->team->name}} Response:</h5>
                            <p class="card-text">{{$feedback_item->answer->text}}</p>
                            <h5 class="card-title">Feedback:</h5>
                            <p class="card-text">{{$feedback_item->text}}</p>
                            <h5 class="card-title">Grade:</h5>
                            <p class="card-text">{{$feedback_item->grade}}</p>
                            <h5 class="card-title">Ready?:</h5>
                            <p class="card-text">@if($feedback_item->ready) Yes @else No @endif</p>
                            @if($feedback_item->ready)
                            <div class="progress mb-3">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                    Ready
                                </div>
                            </div>
                            @else
                                <div class="progress mb-3">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 100%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                        Waiting for response
                                    </div>
                                </div>
                            @endif
                            <div class="text-center">
                                <a href="{{route('feedback.edit', ['feedback' => $feedback_item])}}"
                                   class="btn btn-primary">
                                    Give/Edit Feedback
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
