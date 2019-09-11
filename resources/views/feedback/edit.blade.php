@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Feedback edit</h1>
        @include('layouts.errors')
        <div class="row">
            <div class="col-md-12 my-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Question:</h5>
                        <p class="card-text">{{strip_tags($feedback->answer->step->text)}}</p>
                        <h5 class="card-title">Team {{$feedback->answer->team->name}} Response:</h5>
                        <p class="card-text">{{$feedback->answer->text}}</p>


                        <form method="POST" action="{{route('feedback.update', $feedback)}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="text">Enter Feedback:</label>
                                <textarea class="form-control" id="text" name="text" rows="3"
                                          required>{{old('text', $feedback->text)}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="grade">Feedback Grade (0-4):</label>
                                <input type="number" class="form-control col-1" id="grade" name="grade" value="{{old('grade', $feedback->grade)}}"
                                       required min="0" max="4">
                            </div>

                            @foreach($feedback->files as $file)
                                @if($file->type == "image/png" or $file->type == "image/jpeg")
                                    <img src="{{asset('storage/'.$file->name)}}" height="100px;">
                                @endif
                            @endforeach

                            {{--
                            <div class="form-group">
                                <label for="user_file">File input:</label>
                                <input type="file" class="form-control-file" id="user_file" name="user_file">
                            </div>
                            --}}

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="yes" id="ready" name="ready" @if(old('ready', $feedback->ready)) checked @endif>
                                <label class="form-check-label" for="ready">
                                    Ready?
                                </label>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
