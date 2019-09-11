@extends('layouts.app')

@section('content')
    <div class="col-lg-10">
        <p>{{$student->user->name}}'s Dashboard</p>
    </div>

    <section class="cards">
        <a href="#" class="btn btn-sq mx-4" data-toggle="modal" data-target="#myModal">
            <i class="fas fa-plus-circle fa-5x"></i><br/>
            Join a Class
        </a>

        <!-- The Modal -->
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Join a Class</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <form method="POST" action="{{ route('students.joinClass', ['student' => $student])  }}">
                        @csrf
                        <div class="form-group" controlId="formClassCode">
                            <div class="col-lg-10">
                                <label for="code">Enter your class code:</label>
                                <input type="text" class="form-control" name="join_code" id="join_code">
                                <small id="emailHelp" class="form-text text-muted">If you don't have this code, ask your teacher!</small>
                                <br>
                                <button type="submit" class="btn btn-success">Join</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>




        @foreach($classrooms as $classroom)
            <a href="{{route('classrooms.show', ['classroom'=> $classroom])}}" class="btn btn-sq mx-4">
                <i class="fas fa-chalkboard-teacher fa-5x"></i><br/>
                {{$classroom->name}}

            </a>
        @endforeach

    </section>
@endsection


