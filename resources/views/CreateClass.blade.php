@extends('layouts.app')

@section('content')
    <div class = "container">
        <h1>Create a class</h1>
        {!! Form::open(['action' => 'ClassroomController@store', 'method' => 'POST']) !!}
        
        <!--Class Name input field -->
        <div class="form-group">
            {{Form::label('name', 'Class Name')}}
            {{Form::text('name', '', ['class' => 'form-control col-9', 'placeholder' => 'e.g. Biology 101'])}}
        </div>

        <!--Start Date input field -->
        <div class="form-group">
            {{Form::label('start_date', 'Start Date')}}
            {{Form::date('start_date', \Carbon\Carbon::now(), ['class' => 'form-control col-9', 'placeholder' => '02/2/2019'])}}
        </div>

        <!--End Date input field -->
        <div class="form-group">
            {{Form::label('end_date', 'End Date')}}
            {{Form::date('end_date', \Carbon\Carbon::now(), ['class' => 'form-control col-9', 'placeholder' => '02/2/2019'])}}
        </div>

        <!--Number of Students input field -->
        <div class="form-group">
            {{Form::label('num_students', 'Number of Students')}}
            {{Form::number('num_students', '', ['class' => 'form-control col-9', 'placeholder' => 'e.g. 30'])}}
        </div>

        <!--Number of Teams input field -->
        <div class="form-group">
            {{Form::label('num_teams', 'Number of Teams')}}
            {{Form::number('num_teams', '', ['class' => 'form-control col-9', 'placeholder' => 'e.g. 10'])}}
        </div>

        <!--Challenge dropdown selection -->
        <div class="form-group">
            {{Form::label('challenge', 'Select the Challenge')}}
            {{Form::select('challenge', $challenges, null, ['class' => 'form-control'])}}
        </div>

        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}

    </div>
    {!! Form::close() !!}

@endsection