@extends('layouts.app')

@section('content')
    <div class = "container">
        <h1>{{$challenge->name}}</h1>

        <div class="nav nav-tabs" id="step-nav-tab" role="tablist" aria-orientation="horizontal">
            <a class="nav-link active" id="details-tab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="true">Step Details</a>
            <a class="nav-link" id="resources-tab" data-toggle="tab" href="#resources" role="tab" aria-controls="resources" aria-selected="false">Resources</a>
            <a class="nav-link" id="reminders-tab" data-toggle="tab" href="#reminders" role="tab" aria-controls="reminders" aria-selected="false">Reminders</a>

            @if($steps->isNotEmpty())

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Other steps</a>
                    <div class="dropdown-menu">

                        @php
                            $steps_sorted = $steps->sortBy('step_number');
                            $steps_collected = collect();
                        @endphp

                        @foreach($steps_sorted as $step)
                            @php
                                $number = $step->step_number;
                                $name = $step->name;
                                $steps_collected->push($step);
                            @endphp
                            <a class="dropdown-item" data-toggle="modal" data-target="#stepsModal" data-route="{{route('challenges.edit_step', ['challenge'=>$challenge, 'step'=>$step])}}" data-name="{{$step->name}}" data-text="{{$step->text}}" data-resource_name="{{$step->resources_name}}" data-resource_text="{{$step->resources_text}}" data-resource_rem="{{$step->resources_reminders}}">{{$name}}</a>

                        @endforeach
                    </div>
                </li>
            @endif
        </div>

    @if($steps->isNotEmpty())
        <!-- The Modal -->
            <div class="modal" id="stepsModal" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h5 class="modal-title" id="stepsModalLabel"></h5>
                            <h1 id="testH1"></h1>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class = "container">
                                <h3>Content</h3>
                                <h5 id="name"></h5>
                                <p id="steptext"></p>
                            </div>

                            <div class = "container">
                                <br>
                                <h3>Teaching Resources</h3>
                                <h5 id="resource_name"></h5>
                                <p id="resource_text"></p>
                            </div>
                            <div class = "container">
                                <p id="resource_rem"></p>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <p>Warning: Editing another step will lose work on current step!</p>
                            <a href="" id="route" class="btn btn-danger">Edit</a>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif



        <form method="POST" action="{{ route('challenges.store_step', ['challenge' => $challenge])}}">
            @csrf

            <div class="tab-content" id="challenge-tabContent">

                <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab"><br>
                    <!--Step Name input field -->
                    <div class="form-group">
                        <label for="name">Step Name</label>
                        <input type="text" class="form-control col-10" id="name" name="name" placeholder="e.g. Step 1">
                    </div>

                    <!--Text box for input of step details and instructions -->
                    <textarea name="stepinput" id="stepinput" class="summernote"></textarea><br>

                </div>


                <div class="tab-pane fade show" id="resources" role="tabpanel" aria-labelledby="resources-tab"><br>
                    <div class="form-group">
                        <label for="name">Resource Name</label>
                        <input type="text" class="form-control col-10" id="resource_name" name="resource_name" placeholder="e.g. Step 1">
                    </div>
                    <textarea name="resourcesinput" id="resourcesinput" class="summernote"></textarea><br>
                </div>

                <div class="tab-pane fade show" id="reminders" role="tabpanel" aria-labelledby="reminders-tab"><br>
                    <textarea name="remindersinput" id="remindersinput" class="summernote"></textarea><br>
                </div>


            </div>


            <div class="form-group pull-right">
                <button class="btn btn-primary" type="submit">Save and create another step</button>
                <button type="button" class="btn btn-success" data-toggle="modal"  data-backdrop="static" data-keyboard="false" data-target="#confirmmodal">Complete</button>
            </div>

        </form>
    </div>

    <!-- Modal With Warning -->
    <div id="confirmmodal" class="modal fade" role="dialog" data-backdrop="false">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <p>Should this challenge be set to "active" and made available to classes?</p>

                    <a href="{{ route('challenges.make_active', ['challenge' => $challenge])}}" id="route" class="btn btn-danger">Yes</a>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
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
    </script>
@endsection