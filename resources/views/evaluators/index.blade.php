@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Evaluators') }}</div>

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
                        @foreach($evaluators as $evaluator)
                            <tr>
                                <td>{{$evaluator->user->name}}</td>
                                <td>{{$evaluator->user->email}}</td>
                                <td>
                                    <a href="{{route('evaluators.dashboard', ['evaluator' => $evaluator])}}" class="btn btn-primary">Dashboard</a>
                                    <a href="{{route('evaluators.edit', ['evaluator' => $evaluator])}}" class="btn btn-primary">Edit</a>
                                    <a href="{{route('evaluators.destroy', ['evaluator' => $evaluator])}}" class="btn btn-danger">Archive</a>
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
