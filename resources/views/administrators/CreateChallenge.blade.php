@extends('layouts.app')

@section('content')

    <div class = "container">
        <h1>Create New Challenge</h1>

        <div class="nav nav-pills" id="challenge-nav-tab" role="tablist" aria-orientation="horizontal">
            <a class="nav-link active" id="details-tab" data-toggle="pill" href="#details" role="pill" aria-controls="details" aria-selected="true">Challenge Details</a>
            <a class="nav-link" id="background-tab" data-toggle="pill" href="#background" role="pill" aria-controls="background" aria-selected="false">Background</a>
            <a class="nav-link" id="simulation-tab" data-toggle="pill" href="#simulation" role="pill" aria-controls="simulation" aria-selected="false">Simulation</a>
            <a class="nav-link" id="resources-tab" data-toggle="pill" href="#resources" role="pill" aria-controls="resources" aria-selected="false">Resources</a>
            <a class="nav-link" id="rubric-tab" data-toggle="pill" href="#rubric" role="pill" aria-controls="rubric" aria-selected="false">Rubric</a>
        </div>


        <form method="POST" action="{{ route('challenges.store')}}">
            @csrf

            <div class="tab-content" id="challenge-tabContent">

                <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab"><br>
                    <!--Challenge Name input field -->
                    <div class="form-group">
                        <label for="name">Challenge Name</label>
                        <input type="text" class="form-control col-4" id="name" name="name">
                    </div>

                    <!--Start Date input field -->
                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input type="date" id="start_date" name="start_date" min="2019-01-01" max="3000-12-31" class="form-control col-2">
                    </div>

                    <!--End Date input field -->
                    <div class="form-group">
                        <label for="end_date">End Date</label>
                        <input type="date" id="end_date" name="end_date" min="2019-01-01" max="3000-12-31" class="form-control col-2">
                    </div>
                    <input id="detButton" type="button" value="Next" class="btn btn-primary" />
                    <a href="{{ route('administrators.dashboard', ['administrator'=>\Illuminate\Support\Facades\Auth::user()->userTypeModel()]) }}" class="btn btn-danger"><i class="fas fa-ban"></i> Cancel</a>
                </div>


                <div class="tab-pane fade show" id="background" role="tabpanel" aria-labelledby="background-tab"><br>
                    <label for="name" class="col-sm-2 col-form-label">Background</label>
                    <textarea name="backgroundinput" class="summernote"></textarea><br>
                    <input id="bgButton" type="button" value="Next" class="btn btn-primary" />
                    <a href="{{ route('administrators.dashboard', ['administrator'=>\Illuminate\Support\Facades\Auth::user()->userTypeModel()]) }}" class="btn btn-danger"><i class="fas fa-ban"></i> Cancel</a>

                </div>


                <div class="tab-pane fade" id="simulation" role="tabpanel" aria-labelledby="simulation-tab"><br>
                    <textarea name="simulationinput" id="simulationinput" class="summernote"></textarea><br>
                    <input id="simButton" type="button" value="Next" class="btn btn-primary" />
                    <a href="{{ route('administrators.dashboard', ['administrator'=>\Illuminate\Support\Facades\Auth::user()->userTypeModel()]) }}" class="btn btn-danger"><i class="fas fa-ban"></i> Cancel</a>
                </div>



                <div class="tab-pane fade" id="resources" role="tabpanel" aria-labelledby="resources-tab"><br>
                    <textarea name="resourcesinput" id="resourcesinput" class="summernote"></textarea><br>
                    <input id="resButton" type="button" value="Next" class="btn btn-primary" />
                    <a href="{{ route('administrators.dashboard', ['administrator'=>\Illuminate\Support\Facades\Auth::user()->userTypeModel()]) }}" class="btn btn-danger"><i class="fas fa-ban"></i> Cancel</a>
                </div>


                <div class="tab-pane fade" id="rubric" role="tabpanel" aria-labelledby="rubric-tab"><br>
                    <textarea name="rubricinput" class="summernote"></textarea><br>
                    <button class="btn btn-primary" type="submit"><i class="fas fa-arrow-circle-right"></i> Save & Create Steps </button>
                    <a href="{{ route('administrators.dashboard', ['administrator'=>\Illuminate\Support\Facades\Auth::user()->userTypeModel()]) }}" class="btn btn-danger"><i class="fas fa-ban"></i> Cancel</a>
                </div>

            </div>




        </form>
    </div>
@endsection

@section('javascript')
    <script type="application/javascript">
        $(document).ready(function() {
            $('.summernote').summernote({
                minHeight: 300,             // set minimum height of editor
                maxHeight: null,             // set maximum height of editor
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['link', 'picture', 'hr']],
                    ['view', ['fullscreen', 'codeview']],
                ]
            });
        });

        $('#detButton').on('click', function() {
            $('#challenge-nav-tab a[href="#background"]').tab('show');
        });

        $('#bgButton').on('click', function() {
            $('#challenge-nav-tab a[href="#simulation"]').tab('show');
        });

        $('#simButton').on('click', function() {
            $('#challenge-nav-tab a[href="#resources"]').tab('show');
        });

        $('#resButton').on('click', function() {
            $('#challenge-nav-tab a[href="#rubric"]').tab('show');
        });
    </script>
@endsection