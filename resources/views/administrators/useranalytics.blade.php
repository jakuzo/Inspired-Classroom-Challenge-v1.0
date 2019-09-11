@extends('layouts.app')

@section('content')
        <div class="container">
                <div class="col-lg">
                    <h1>User Management</h1>

                    <div class="row justify-content-center my-4">
                            <form action="{{ route('administrators.search')}}" method="POST" role="search">
                                @csrf
                                <div class="input-group">
                                    <input type="text" class="form-control col-12" name="q"
                                    placeholder="Search users"> <span class="input-group-btn">
                                        <button type="submit" class="btn btn-default">
                                            <span class="glyphicon glyphicon-search"></span>
                                        </button>
                                    </span>
                                </div>
                            </form>

                    </div>

                    <div class="row justify-content-start">
                        <ul class="nav flex-column nav-pills mx-3" id="pills-tab" role="tablist" aria-orientation="vertical">
                            <li class="nav-item">
                                <a class="nav-link active" id="administrators-tab" data-toggle="pill" href="#administrators" role="tab" aria-controls="administrators" aria-selected="true">Administrators</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="teachers-tab" data-toggle="pill" href="#teachers" role="tab" aria-controls="teachers" aria-selected="false">Teachers</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="students-tab" data-toggle="pill" href="#students" role="tab" aria-controls="students" aria-selected="false">Students</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="evaluators-tab" data-toggle="pill" href="#evaluators" role="tab" aria-controls="evaluators" aria-selected="false">Evaluators</a>
                            </li>
                        </ul>


                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="administrators" role="tabpanel" aria-labelledby="administrators-tab">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($administrators as $user)
                                        <tr>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="teachers" role="tabpanel" aria-labelledby="teachers-tab">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($teachers as $user)
                                        <tr>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="students" role="tabpanel" aria-labelledby="students-tab">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($students as $user)
                                        <tr>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="evaluators" role="tabpanel" aria-labelledby="evaluators-tab">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($evaluators as $user)
                                        <tr>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
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