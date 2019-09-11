@extends('layouts.app')


@section('content')
<div class="container-fluid" style="padding-left: 20%; padding-right: 20%; text-align: center;">
        <div class="row">
                <div class="panel col-sm-6" style="max-width: 800px;">
                    <div class="panel-body">
                        <ul class="list-group">
                            <li class="list-group-item">Instructor: {{$teacher->user->name}} </li>
                            <li class="list-group-item">Class: {{$classroom->name}}</li>
                            <li class="list-group-item">Class Code: {{$classroom->join_code}}</li>
                            
                        </ul> 
                    </div> 
                </div>
                <div class="panel col-sm-6">
                        <div class="panel-body">
                            <ul class="list-group">
                                <li class="list-group-item">Number of Teams: {{$classroom->num_teams}} </li>
                                <li class="list-group-item">Number of Students: {{$classroom->num_students}} </li>
                                <li class="list-group-item">Registered Challenge: {{$classroom->challenge->name}}</li>
                            </ul> 
                        </div> 
                    </div>
            </div>

</div>


<div class="container-fluid class-body-container" >
        <div class="row">
                <div class="col-sm-6" style="margin-bottom: 50px;">
        
                
        
                            <!--Team Column -->
                            <div class="team-title-cards"> <h3>Teams</h3></div>
                            
                            @foreach($teams as $team)
                                <div class="team-cards" >
                                    <h5 class="card-title"> Team {{$team->name}}</h5>
                                    <h5 class="card-title"> ID {{$team->id}}</h5>
                                    <a href="{{ route('teams.viewChallenge')}}" class="btn btn-primary">
                                        
                                        View challenge
                                    </a>
        
                                    <!--Members of the team -->
                                    @foreach($team->students as $student)
                                      <ul class="list-group list-group-flush">
                                          <li class = "list-group-item">
                                              <h5 class="card-body"> {{$student->user->name}} </h5>
                                              <a href="{{ route('teams.removeStudent', ['team'=>$team, 'student'=>$student]) }}" class="button btn-warning" style="width: 100px; height: 30px; display: block; margin: 0 auto;">Remove</a>
                                          </li>
                                      </ul>
                                    @endforeach
        
                                    <!--Add student to team -->
                                    <form method="POST" action="{{ route('teams.addStudent', $team) }}">
                                        @csrf
                                        <input type="number" class="form-control" style="margin-top: 20px;" id={{$team}} name="student" placeholder="Enter student ID">
                                        <button type="submit" class="btn btn-primary" style="margin-top: 15px; margin-bottom: 15px;">Add Student</button>
                                    </form>
                                </div>
                            @endforeach
        
                            <div class="team-cards" >
                                <h5 class="card-title"> Add Team</h5>
                                <i class="fas fa-plus-circle fa-5x"></i><br/>
                                <br>
                            </div>
                    
                </div>
                
        
                <div class="col-sm-6" style="height: 100%;"  >
                    <div class="student-title-cards" > <h3>Students</h3></div>
                        @foreach($students as $student)
        
                                <!--I set the team-cards class right here!!!-->
                                    <div class="student-cards">
                                        <div class="card-body"> 
                                            <h5>{{$student->user->name}} ID: {{$student->id}}</h5>
                                        </div>
                                        
                                    </div>
                                @endforeach
                                <div class="student-cards">
                                        <h5 class="card-body"> Add Student</h5>
                                        <i class="fas fa-plus-circle fa-5x"></i><br/>
                                        
        
                                    </div>
        
                </div>
        
        
        
                          
        
                        </ul>
                    </div>
                </div>
        
            </div>

</div>


    

@endsection