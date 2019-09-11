@extends('layouts.app')

@section('content')
    <section class="cards">
        <a href="{{ route('challenges.manage')}}"  class="btn btn-sq mx-4">
            <i class="fas fa-edit fa-4x"></i><br/>
            View/Edit Challenges
        </a>
        <a href="{{ route('challenges.create')}}" class="btn btn-sq mx-4">
            <i class="fas fa-plus-circle fa-4x"></i><br/>
            Create New Challenge
        </a>

        <a href="{{ route('administrators.index_users', ['administrator'=>$administrator])}}" class="btn btn-sq mx-4">
            <i class="fas fa-users fa-4x"></i><br/>
            User Analytics
        </a>

        <a href="{{ route('challenges.get_progress_all')}}" class="btn btn-sq mx-4">
            <i class="fas fa-tasks fa-4x"></i><br/>
            Challenges Overview
        </a>


        <a href="#" class="btn btn-sq mx-4">
            <i class="fas fa-check fa-4x"></i><br/>
            Manage Reviewers
        </a>

    </section>
@endsection