@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Teachers') }}</div>

                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($teachers as $teacher)
                            <tr>
                                <td>{{$teacher->user->name}}</td>
                                <td>{{$teacher->user->email}}</td>
                                <td>
                                    <a href="{{route('teachers.dashboard', ['teacher' => $teacher])}}" class="btn btn-primary">Dashboard</a>
                                    <a href="{{route('teachers.edit', ['teacher' => $teacher])}}" class="btn btn-primary">Edit</a>
                                    <a href="{{route('teachers.destroy', ['teacher' => $teacher])}}" class="btn btn-danger">Archive</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
