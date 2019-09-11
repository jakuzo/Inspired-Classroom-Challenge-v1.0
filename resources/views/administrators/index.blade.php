@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Administrators') }}</div>

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
                        @foreach($administrators as $administrator)
                            <tr>
                                <td>{{$administrator->user->name}}</td>
                                <td>{{$administrator->user->email}}</td>
                                <td>
                                    <a href="{{route('administrators.dashboard', ['administrator' => $administrator])}}" class="btn btn-primary">Dashboard</a>
                                    <a href="{{route('administrators.edit', ['administrator' => $administrator])}}" class="btn btn-primary">Edit</a>
                                    <a href="{{route('administrators.destroy', ['administrator' => $administrator])}}" class="btn btn-danger">Archive</a>
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
