@extends('layouts.app')

@section('content')
    <div class="col-lg-10">
        <p>{{$teacher->user->name}}'s Dashboard</p>
    </div>
        <section class="cards">
            <a href="{{ route('classrooms.create') }}" class="btn btn-sq mx-4">
                <i class="fas fa-plus-circle fa-5x"></i><br/>
                Create a Classs
            </a>

            @foreach($classrooms as $classroom)
                <a href="{{route('classrooms.show', ['classroom'=> $classroom, 'teacher'=>$teacher])}}" class="btn btn-sq mx-4 text-center" style="text-align:center">
                    <i class="fas fa-chalkboard-teacher fa-5x"></i>
                    {{$classroom->name}}
                    <span style="color: #595a5b; font-size:10pt;">{{$classroom->join_code}}</span>
                </a>
            @endforeach
        </section>
@endsection
