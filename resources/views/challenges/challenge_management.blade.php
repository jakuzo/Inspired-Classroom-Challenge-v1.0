@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-lg">
                <h1>Manage Challenges</h1><br>

                <div class="row justify-content-around">
                    <div class="col-sm col-challenges" style="text-align: center">
                        <h2>Active Challenges</h2>
                        @foreach ($all_challenges as $challenge)
                            @if($challenge->active == 1)
                                <div class="card challenge-card mx-auto" style="width: 20rem">
                                    <div class="card-body">
                                        <h5 class="card-title" style="font-size:1.3em">{{ $challenge->name }}</h5>
                                        <a href="{{route('challenges.view_challenge', ['challenge'=> $challenge])}}"class="btn btn-info">View</a>
                                        <a href="{{route('challenges.edit_challenge', ['challenge'=>$challenge])}}" class="btn btn-secondary">Edit</a>


                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>


                    <div class="col-sm" style="text-align: center">
                        <h2>Inactive Challenges</h2>
                        @foreach ($all_challenges as $i)
                            @if($i->active == 0)
                                <div class="card challenge-card mx-auto" style="width: 20rem">
                                    <div class="card-body">
                                        <h5 class="card-title" style="font-size:1.3em">{{ $i->name }}</h5>
                                        <a href="{{route('challenges.view_challenge', ['challenge'=> $challenge])}}"class="btn btn-info">View</a>
                                        <a href="{{route('challenges.edit_challenge', ['challenge'=>$challenge])}}" class="btn btn-secondary">Edit</a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
</div>
@endsection