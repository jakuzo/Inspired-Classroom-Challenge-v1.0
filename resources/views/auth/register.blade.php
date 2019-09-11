@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="user_type" class="col-md-4 col-form-label text-md-right">Select User
                                    Type</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="user_type" name="user_type" required autofocus>
                                        <option value="administrator"
                                                @if( old('user_type') == 'administrator') selected @endif>Administrator
                                        </option>
                                        <option value="evaluator" @if( old('user_type') == 'evaluator') selected @endif>
                                            Evaluator
                                        </option>
                                        <option value="student" @if( old('user_type') == 'student') selected @endif>
                                            Student
                                        </option>
                                        <option value="teacher" @if( old('user_type') == 'teacher') selected @endif>
                                            Teacher
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           name="name" value="{{ old('name') }}" required>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required>
                                </div>
                            </div>

                            <div id="teacher">
                                <div class="form-group row">
                                    <label for="school" class="col-md-4 col-form-label text-md-right">Select
                                        School</label>
                                    <div class="col-md-6">
                                        <select class="form-control" id="school" name="school">
                                            @foreach($schools as $school)
                                                <option value={{$school->id}} @if( old('school') == $school->id) selected @endif>{{$school->name}} {{$school->zipcode->zip}}</option>
                                            @endforeach
                                            <option value=0>Create new School</option>
                                        </select>
                                        <span>
                                            Note: if you School is not on the list, select "Create new School" at the bottom.
                                        </span>
                                    </div>
                                </div>

                                <div id="school_new">
                                    <div class="form-group row">
                                        <label for="school_name"
                                               class="col-md-4 col-form-label text-md-right">{{ __('School Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="school_name" type="text"
                                                   class="form-control{{ $errors->has('school_name') ? ' is-invalid' : '' }}"
                                                   name="school_name" value="{{ old('school_name') }}">

                                            @if ($errors->has('school_name'))
                                                <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $errors->first('school_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="school_address_line"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Address Line') }}</label>

                                        <div class="col-md-6">
                                            <input id="school_address_line" type="text"
                                                   class="form-control{{ $errors->has('school_address_line') ? ' is-invalid' : '' }}"
                                                   name="school_address_line" value="{{ old('school_name') }}">

                                            @if ($errors->has('school_address_line'))
                                                <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $errors->first('school_address_line') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="school_frlp"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Free and Reduced Lunch Program') }}</label>

                                        <div class="col-md-6">
                                            <input id="school_frlp" type="number"
                                                   class="form-control{{ $errors->has('school_frlp') ? ' is-invalid' : '' }}"
                                                   name="school_frlp" value="{{ old('school_frlp') }}">

                                            @if ($errors->has('school_frlp'))
                                                <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $errors->first('school_frlp') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="school" class="col-md-4 col-form-label text-md-right">Select
                                            Zip Code</label>
                                        <div class="col-md-6">
                                            <select class="form-control" id="school_zip" name="school_zip">
                                                @foreach($zipcodes as $zipcode)
                                                    <option value={{$zipcode->id}} @if( old('school_zip') == $zipcode->id) selected @endif>{{$zipcode->zip}}</option>
                                                @endforeach
                                                <option value=0>Create new Zip Code</option>
                                            </select>
                                            <span>
                                            Note: if you Zip Code is not on the list, select "Create new Zip Code" at the bottom.
                                        </span>
                                        </div>
                                    </div>

                                    <div id="zip_new">

                                        <div class="form-group row">
                                            <label for="zip_code"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('Zip Code') }}</label>

                                            <div class="col-md-6">
                                                <input id="zip_code" type="text"
                                                       class="form-control{{ $errors->has('zip_code') ? ' is-invalid' : '' }}"
                                                       name="zip_code" value="{{ old('zip_code') }}">

                                                @if ($errors->has('zip_code'))
                                                    <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $errors->first('zip_code') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="zip_state" class="col-md-4 col-form-label text-md-right">Select
                                                State</label>
                                            <div class="col-md-6">
                                                <select class="form-control" id="zip_state" name="zip_state">
                                                    @foreach($states as $state)
                                                        <option value={{$state->id}} @if( old('zip_state') == $state->id) selected @endif>{{$state->name}}
                                                            ({{$state->abbreviation}})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="zip_city"
                                                   class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                                            <div class="col-md-6">
                                                <input id="zip_city" type="text"
                                                       class="form-control{{ $errors->has('zip_city') ? ' is-invalid' : '' }}"
                                                       name="zip_city" value="{{ old('zip_city') }}">

                                                @if ($errors->has('zip_city'))
                                                    <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $errors->first('zip_city') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        if ($('#user_type').val() !== 'teacher') {
            $("#teacher").attr("hidden", true);

            if ($('#school').val() !== 0) {
                $("#school_new").attr("hidden", true);

                if ($('#school_zip').val() !== 0) {
                    $("#zip_new").attr("hidden", true);
                }
            }

        }


        ($('#user_type').change(function () {
            if ($('#user_type').val() === 'teacher') {
                $("#teacher").attr("hidden", false);

                $('#school').change(function () {
                    if ($('#school').val() == 0) {
                        $("#school_new").attr("hidden", false);

                        $('#school_zip').change(function () {
                            if ($('#school_zip').val() == 0) {
                                $("#zip_new").attr("hidden", false);
                            } else {
                                $("#zip_new").attr("hidden", true);
                            }
                        });

                    } else {
                        $("#school_new").attr("hidden", true);
                    }
                });

            } else {
                $("#teacher").attr("hidden", true);
            }
        }));
    </script>
@stop