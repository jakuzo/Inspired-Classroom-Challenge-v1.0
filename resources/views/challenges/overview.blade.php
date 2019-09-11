@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <p class="display-5">Challenge: {{$challenge->name}}</p>
            </div>
        </div>
        <div class="row justify-content-start">
            <p class="lead ml-5">Active: {{ \Carbon\Carbon::parse($challenge->start_date)->format('m/d/Y')}} to {{ \Carbon\Carbon::parse($challenge->end_date)->format('m/d/Y')}}</p>
            <p class="lead ml-5"><a href="#" class="btn btn-lg btn-primary">Generate report </a></p>
        </div>
        @php
        $student_tot = 0;
        $team_tot = 0;
        $teacher_tot = $teachers->count();
            foreach($classes as $class){
                $student_tot = $student_tot + $class->num_students;
                $team_tot = $team_tot + $class->num_teams;
            }
        @endphp
        <div class="col-lg">
                <div class="row justify-content-around">
                    <div class="col-sm" style="text-align: center">
                                <div class="card mx-auto" style="width: 20rem">
                                    <h2>Overview</h2>
                                    <div class="card-body">
                                        <div class="card bg-light mb-3" style="max-width: 18rem;">
                                            <div class="card-body">
                                                <h5 class="card-title">Number of Students</h5>
                                                <p class="card-text">{{$student_tot}}
                                                </p>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title">Number of Teams</h5>
                                                <p class="card-text">{{$team_tot}}</p>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title">Number of Teachers</h5>
                                                <p class="card-text">{{$teacher_tot}}</p>                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </div>

                    <div class="col-sm" style="text-align: center">
                        <div class="card mx-auto" style="width: 20rem">
                            <h2>Schools participating</h2>
                            <div class="card-body">
                                @foreach($schools as $school)
                                    <a href="{{route('challenges.view_school', ['challenge'=> $challenge, 'school' => $school])}}" class="btn btn-schools" style="text-align:center">
                                        {{$school->name}}
                                    </a>
                                @endforeach

                            </div>
                        </div>
                    </div>

                </div>
            </div>
    </div>
@endsection