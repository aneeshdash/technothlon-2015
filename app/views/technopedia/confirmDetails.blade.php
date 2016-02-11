@extends('layouts.master')
@section('title')
    Online Registration
@endsection
@section('description')
    Online Registration
@endsection
@section('head')
    <!--<link rel="stylesheet" type="text/css" href="register.css"> -->
    <link rel="stylesheet" type="text/css" href="{{ asset('CSS/register.css') }}">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet' type='text/css'>
    {{--<link href="CSS/font-awesome.css" rel="stylesheet" type="text/css">--}}
    {{--<link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">--}}
    <link href="{{ asset("font-awesome-4.2.0/css/font-awesome.min.css") }}" rel="stylesheet" />
@endsection
@section('body')
     <div class="container">
            <h1>Roll Number Recovery</h1>
            <div style="display: inline-block">
                <form id="register" action="{{ route('rollrecover') }}" method="post">
                    <hr>
                    <div style="display: inline-block; width: 100%">
                        <div style="display: inline-block">
                            <h3 style="display: inline; display: inline-block ">State: </h3>
                            <select required id="state" name="state" style="margin-left: 10px">
                                <option value="">Select State</option>
                                @foreach(State::orderBy('name')->get() as $state)
                                    <option value="{{ $state->id }}">{{$state->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div style="display: inline-block; margin-left: 5%">
                            <h3 style="display: inline">City: </h3>
                            <select required disabled id="city" name="city" style="margin-left: 10px; width: 200px">
                                <option value="">Select City</option>
                            </select>
                        </div>
                    </div>
                    <div style="display: inline-block; width: 100%; margin-top: 2%">
                        <h3 style="display: inline">School: </h3>
                        <select required disabled id="school" name="school" style=" width: 80%">
                            <option value="">Select School</option>
                        </select>
                    </div>
                    <div style="display: inline-block; width: 100%; margin-top: 2%">
                        <hr>
                        <div style="display: inline-block; width: 45%">
                            <h2 align="center">Participant 1</h2>
                            <div style="display: inline-block; width: 100%">
                                <div style="display: inline-block; clear: left; width: 100%"><label id="icon" for="name"><i class="fa fa-user"></i></label>
                                    <input type="text" name="name1" id="name" placeholder="First Name" required value="{{ Input::old('name1') }}" style="width: 75%"></div>
                            </div>
                        </div>
                        <div style="display: inline-block; width: 45%">
                            <h2 align="center">Participant 2</h2>
                            <div style="display: inline-block; clear: left; width: 100%"><label id="icon" for="name"><i class="fa fa-user"></i></label>
                                <input type="text" name="name2" id="name" placeholder="First Name" value="{{ Input::old('name2') }}" required style="width: 75%"></div>
                        </div>
                    </div>
                    <div style="display: inline-block; width: 100%">
                        <div class="center" style="margin-top: 50px">
                            <!--<a href="" class="button" onclick="document.register.submit()">Register</a>-->
                            <input type="submit" value="Submit" onclick="$('#school').prop('disabled', 0)" style="padding: 6px">
                        </div></div>
                </form>
            </div>
        </div>

    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
    <script type="text/javascript">
        $('#state').change(function () {
            $('#school').val('');
            $('#school').prop("disabled", 1);
            $("#city").prop("disabled", !$('#state').val());
            var city = "{{ route('getcities') }}";
            $.ajax({
                url: city,
                method: 'post',
                data: {state: $(this).val()},
                success: function(result) {
                    $('#city').html(result);
                }
            })
        });

        $('#city').change(function () {
                $("#school").prop("disabled", !$('#city').val());
                var school = "{{ route('schoollist') }}";
                $.ajax({
                    url: school,
                    method: 'post',
                    data: {city: $(this).val()},
                    success: function(result) {
                        $('#school').html(result);
                    }
                })
        });
    </script>
@endsection