<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/>

@extends('layouts.app')

@section('content')
    <div class = "container">
        <h1>{{$challenge->name}}</h1>
        <div class="nav nav-tabs" id="v-pills-tab" role="tablist" aria-orientation="horizontal">
            @if($steps->isNotEmpty())
                @foreach($steps as $step)
                    @php
                        $number = $step->step_number;
                        $name = $step->name;
                    @endphp
                    <a class="nav-link" id="{{$name}} tab" data-toggle="tab" href="{{$name}}" role="tab" aria-controls="{{$name}}" aria-selected="false">{{$name}}</a>
                @endforeach
            @endif
            <a class="nav-link active" id="add-tab" data-toggle="tab" href="#add" role="tab" aria-controls="add" aria-selected="false">Add a step</a>
        </div>



        <div class="tab-content" id="v-pills-tabContent">
            @if($steps->isNotEmpty())
                @php
                    $steps_sorted = $steps->sortBy('step_number');
                @endphp
                @foreach($steps_sorted as $step)
                    @php
                        $number = $step->step_number;
                        $name = $step->name;
                    @endphp
                <div class="tab-pane fade" id="{{$name}} tab" role="tabpanel" aria-labelledby="{{$name}}">
                    <div class="nav nav-tabs" id="step-nav-tab" role="tablist" aria-orientation="horizontal">
                        <a class="nav-link active" id="details-tab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="true">Step Details</a>
                        <a class="nav-link" id="resources-tab" data-toggle="tab" href="#resources" role="tab" aria-controls="resources" aria-selected="false">Resources</a>
                        <a class="nav-link" id="reminders-tab" data-toggle="tab" href="#reminders" role="tab" aria-controls="reminders" aria-selected="false">Reminders</a>
                    </div>


                    <form method="POST" action="{{ route('challenges.store_step', ['challenge' => $challenge])}}">
                    @csrf

                    <div class="tab-content" id="challenge-tabContent">

                        <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab"><br>
                            <div class="search">
                                <h3 class="text-center title-color">Drag and Drop Datatables Using jQuery UI Sortable - Demo </h3>
                                <p>&nbsp;</p>
                                <div class="row">
                                    <div class="col-lg-10 col-lg-offset-1">
                                        <table id="table" class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Status</th>
                                                <th>Created At</th>
                                            </tr>
                                            </thead>
                                            <tbody id="tablecontents">
                                            @foreach($steps_sorted as $step)
                                                <tr class="row1" data-id="{{ $step->step_number }}">
                                                    <td>
                                                        <div style="color:rgb(124,77,255); padding-left: 10px; float: left; font-size: 20px; cursor: pointer;" title="change display order">
                                                            <i class="fa fa-ellipsis-v"></i>
                                                            <i class="fa fa-ellipsis-v"></i>
                                                        </div>
                                                    </td>
                                                    <td>{{ $step->name }}</td>
                                                    <td>{{ date('d-m-Y h:m:s',strtotime($step->created_at)) }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                                <h5>Drag and Drop the table rows and <button class="btn btn-default" onclick="window.location.reload()"><b>REFRESH</b></button> the page to check the Demo. For the complete tutorial of how to make this demo app visit the following <a href="#">Link</a>.</h5>
                            </div>

                            <!--Step Name input field -->
                            <div class="form-group">
                                <label for="name">Step Name</label>
                                <input type="text" class="form-control col-10" id="name" name="name" placeholder="e.g. Step 1">
                            </div>

                            <!--Text box for input of step details and instructions -->
                            <textarea name="stepinput" id="stepinput" class="summernote"></textarea><br>

                        </div>


                        <div class="tab-pane fade" id="resources" role="tabpanel" aria-labelledby="resources-tab"><br>
                            <textarea name="resourcesinput" id="resourcesinput" class="summernote"></textarea><br>
                        </div>

                        <div class="tab-pane fade" id="reminders" role="tabpanel" aria-labelledby="reminders-tab"><br>
                            <textarea name="remindersinput" id="remindersinput" class="summernote"></textarea><br>
                        </div>


                    </div>


                    <div class="form-group pull-right">
                        <button class="btn btn-primary" type="submit">Create another step</button>
                        <button class="btn btn-primary" href="{{ route('administrators.dashboard', ['administrator'=>\Illuminate\Support\Facades\Auth::user()->userTypeModel()]) }}">Complete</button>
                    </div>

                </form>
                </div>
                @endforeach
            @endif


            <!--Tab content for default "add a step" pane -->

                <div class="tab-pane fade show active" id="add" role="tabpanel" aria-labelledby="add-tab"><br>
                    <div class="nav nav-tabs" id="step-nav-tab" role="tablist" aria-orientation="horizontal">
                        <a class="nav-link active" id="details-tab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="true">Step Details</a>
                        <a class="nav-link" id="resources-tab" data-toggle="tab" href="#resources" role="tab" aria-controls="resources" aria-selected="false">Resources</a>
                        <a class="nav-link" id="reminders-tab" data-toggle="tab" href="#reminders" role="tab" aria-controls="reminders" aria-selected="false">Reminders</a>
                    </div>



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


                            <div class="tab-pane fade" id="resources" role="tabpanel" aria-labelledby="resources-tab"><br>
                                <textarea name="resourcesinput" id="resourcesinput" class="summernote"></textarea><br>
                            </div>


                        </div>


                        <div class="form-group pull-right">
                            <button class="btn btn-primary" type="submit">Create another step</button>
                            <a href="{{ route('administrators.dashboard', ['administrator'=>\Illuminate\Support\Facades\Auth::user()->userTypeModel()]) }}" class="btn btn-success"> Complete</a>
                        </div>

                    </form>

                </div>

        </div>

    </div>

@endsection

<script type="text/javascript" src="//code.jquery.com/ui/1.12.1/jquery-ui.js" ></script>

<!-- Datatables Js-->
<script type="text/javascript" src="//cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>

<script type="application/javascript">
    $(function () {

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

        $("#table").DataTable();

        $( "#tablecontents" ).sortable({
            items: "tr",
            cursor: 'move',
            opacity: 0.6,
            update: function() {
                sendOrderToServer();
            }
        });

        function sendOrderToServer() {

            var order = [];
            $('tr.row1').each(function(index,element) {
                order.push({
                    id: $(this).attr('data-id'),
                    position: index+1
                });
            });

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ url('demos/sortabledatatable') }}",
                data: {
                    order:order,
                    _token: '{{csrf_token()}}'
                },
                success: function(response) {
                    if (response.status == "success") {
                        console.log(response);
                    } else {
                        console.log(response);
                    }
                }
            });

        }
    });

</script>


