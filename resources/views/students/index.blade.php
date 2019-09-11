@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Students') }}</div>

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
                        @foreach($students as $student)
                            <tr>
                                <td>{{$student->user->name}}</td>
                                <td>{{$student->user->email}}</td>
                                <td>
                                    <a href="{{route('students.dashboard', ['student' => $student])}}" class="btn btn-primary">Dashboard</a>
                                    <a href="{{route('students.edit', ['student' => $student])}}" class="btn btn-primary">Edit</a>
                                    <a href="{{route('students.destroy', ['student' => $student])}}" class="btn btn-danger">Archive</a>
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
