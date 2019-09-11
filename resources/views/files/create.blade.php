@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Files store</h1>

        @include('layouts.errors')
        <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="user_file">Example file input</label>
                <input type="file" class="form-control-file" id="user_file" name="user_file">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
@endsection