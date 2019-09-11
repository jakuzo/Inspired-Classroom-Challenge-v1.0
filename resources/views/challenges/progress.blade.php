@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm">
                {{--@foreach($challenges as $challenge)

                    @php($steps = $challenge->steps)
                    @php($answers = $challenge->answers())


                    <div><p>{{$challenge->name}}</p><br></div>

                    @foreach($steps as $step)
                       <div><p>{{$step->name}}</p><br></div>
                    <br>
                    @endforeach

                    @foreach($answers as $answer)
                        <p>{{$answer->classroom_id}}</p><br>
                        <p>{{$answer->ready}}</p><br>
                    <br>
                    @endforeach

                @endforeach--}}

                    <div class="col-lg">
                <h1>Active Challenges</h1><br>
                    <h3>   Grizzly Bear Challenge</h3><br>
                        @while($stats->isNotEmpty())
                            @php($item = $stats->pop())
                            @php($num=1)
                            @while($item->count() > 6)
                                @php($layer2 = $item->shift())
                                @php($perc = (($layer2 * 100)-($num*7)))
                                <div class="progress" style="height: 40px; margin: 10px; width: 750px" >
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{$perc}}%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">Step {{$num}}</div><br>
                                </div>
                                @php($num++)
                            @endwhile

                        @endwhile

            </div>
        </div>
        <div class="col-md">
        </div>
</div>
@endsection