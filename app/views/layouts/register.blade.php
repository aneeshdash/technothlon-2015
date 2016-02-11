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
        <h1>Registration</h1>
        <div style="display: inline-block">
            <form id="register" action="{{ route('register') }}" method="post">
                <hr>
                <div style="display: inline-block; width: 100%">
                    <div style="display: inline-block">
                        <h3 style="display: inline; display: inline-block ">State: </h3>
                        <select required id="state" name="state" style="margin-left: 10px">
                            <option value="">Select State</option>
                            @foreach(State::all() as $state)
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
                    <div style="display: inline-block; margin-left: 5%">
                        <input id="other_city" type="text" name="other_city" placeholder="Your City" style="margin-top: 2px; margin-left: 1%; height: 15px ;display: none; padding: 6px">
                    </div>
                </div>
                <div class="centre" style="display: inline-block; width: 100%; margin: 10px 0px 15px 0px; background-color: khaki; display: none">
                    <div style="display: inline-block; height: 100%">
                        <p style="vertical-align: middle"><b>Note: There is no city representative in your city.<br> Please select another city as your examination center</b></p>
                    </div>
                    <div style="display: inline-block; height: 100%;margin-top: 8px; margin-left: 5%">
                        <h3 style="display: inline">Centre:</h3>
                        <select id="centre" name="centre">
                            <option value="">Select Centre</option>
                            @foreach(State::all() as $state)
                                <optgroup label="{{ $state->name }}">
                            @foreach(City::where('state_id', $state->id)->get() as $city)
                                @if(CityRep::where('city_id', $city->id)->count() >0)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endif
                            @endforeach
                                </optgroup>
                                @endforeach
                        </select>
                    </div>
                </div>
                <div style="display: inline-block; width: 100%; margin-top: 2%">
                    <h3 style="display: inline">School: </h3>
                    <select required disabled id="school" name="school" style=" width: 80%">
                        <option value="">Select School</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="other_school" style="display: inline-block; width: 100%; display: none; margin-top: 20px">
                    <h2 align="center">School Details</h2>
                    <p style="font-size: 100%">*Your registration will be successful once your School details has been verified.</p>
                    <div style="display: inline-block; width: 100%">
                        <ul>
                            @if($errors->has())
                                {{ $errors->first('name', '<li>:message</li>') }}
                                {{ $errors->first('addr1', '<li>:message</li>') }}
                                {{ $errors->first('pincode', '<li>:message</li>') }}
                                {{ $errors->first('contact', '<li>:message</li>') }}
                            @endif
                        </ul>
                    </div>
                    <div style="display: inline-block; width: 100%; margin-top: 10px">
                        <div style="display: inline-block; clear: left; width: 100%"><label id="icon" for="name"><i class="fa fa-home"></i></label>
                            <input type="text" class="other_school" name="name" id="name" placeholder="School Name" value="{{ Input::old('name') }}" style="width: 75%"/></div>
                        <div style="display: inline-block; clear: left; width: 100%"><label id="icon" for="name"><i class="fa fa-map-marker "></i></label>
                            <input type="text" class="other_school" name="addr1" id="name" placeholder="Address Line 1" value="{{ Input::old('addr1') }}" style="width: 75%"/></div>
                        <div style="display: inline-block; clear: left; width: 100%"><label id="icon" for="name"><i class="fa fa-map-marker "></i></label>
                            <input type="text" name="addr2" id="name" placeholder="Address Line 2" value="{{ Input::old('addr2') }}" style="width: 75%"/></div>
                        <div style="display: inline-block; clear: left; width: 100%"><label id="icon" for="name"><i class="fa fa-envelope-o "></i></label>
                            <input type="text" class="other_school" name="email" id="name" placeholder="School Email-Id" value="{{ Input::old('email') }}" style="width: 75%"/></div>
                        <div style="display: inline-block; clear: left"><label id="icon" for="name"><i class="fa fa-send"></i></label>
                            <input type="text" class="other_school" name="pincode" id="name" placeholder="Pin Code" value="{{ Input::old('pincode') }}" /></div>
                        <div style="display: inline-block"><label id="icon" for="name"><i class="fa fa-phone-square"></i></label>
                            <input type="text" class="other_school" name="contact" id="name" placeholder="School Contact" value="{{ Input::old('contact') }}"/></div>
                    </div>
                </div>
                <div id="details" style="clear: left; display: inline-block; width: 100%; margin-top: 30px">
                    <hr>
                    <div style="width:49%; display: inline-block">
                        <h3 align="center">Medium</h3>
                        <div style="display: inline-block; width: 47%; margin-top: 10px; text-align: center">
                            <input type="radio" value="en" id="mediumen" name="language" checked/>
                            <label for="mediumen" class="radio">English</label></div>
                        <div style="width: 47%; display: inline-block; margin-top: 10px; text-align: center">
                            <input type="radio" value="hi" id="mediumhi" name="language" />
                            <label for="mediumhi" class="radio">Hindi</label>
                        </div></div><!--
           --><div style="width:49%; float: right">
                        <h3 align="center">Squad</h3>
                        <div style="display: inline-block; width: 47%; margin-top: 10px; text-align: center">
                            <input type="radio" value="JUNIOR" id="sqju" name="squad" checked/>
                            <label for="sqju" class="radio" chec>Junior</label></div>
                        <div style="display: inline-block; width: 47%; margin-top: 10px; text-align: center">
                            <input type="radio" value="HAUTS" id="sqhau" name="squad" />
                            <label for="sqhau" class="radio">Hauts</label>
                        </div></div>
                </div>
                <div style="display: inline-block; width: 100%">
                    <hr>
                    <div style="width: 100%">
                        <ul>
                            @if($errors->has())
                                {{ $errors->first('name1', '<li>:message</li>') }}
                                {{ $errors->first('name2', '<li>:message</li>') }}
                                {{ $errors->first('email1', '<li>:message</li>') }}
                                {{ $errors->first('email2', '<li>:message</li>') }}
                                {{ $errors->first('contact1', '<li>:message</li>') }}
                                {{ $errors->first('contact2', '<li>:message</li>') }}
                            @endif
                        </ul>
                    </div>
                    <div style="display: inline-block; width: 45%">
                        <h2 align="center">Participant 1</h2>
                        <div style="display: inline-block; width: 100%">
                            <div style="display: inline-block; clear: left; width: 100%"><label id="icon" for="name"><i class="fa fa-user"></i></label>
                                <input type="text" name="name1" id="name" placeholder="Name" required value="{{ Input::old('name1') }}" style="width: 75%"></div>
                            <div style="display: inline-block; clear: left; width: 100% "><label id="icon" for="name"><i class="fa fa-envelope "></i></label>
                                <input required type="email" name="email1" id="name" placeholder="Email" value="{{ Input::old('email1') }}" style="width: 75%"></div>
                            <div style="display: inline-block; clear: left; width: 100%"><label id="icon" for="name"><i class="fa fa-phone"></i></label>
                                <input type="text" name="contact1" id="name" placeholder="Contact" value="{{ Input::old('contact1') }}" style="width: 75%" required></div>
                        </div>
                    </div>
                    <div style="display: inline-block; width: 45%">
                        <h2 align="center">Participant 2</h2>
                        <div style="display: inline-block; clear: left; width: 100%"><label id="icon" for="name"><i class="fa fa-user"></i></label>
                            <input type="text" name="name2" id="name" placeholder="Name" value="{{ Input::old('name2') }}" required style="width: 75%"></div>
                        <div style="display: inline-block; clear: left; width: 100%"><label id="icon" for="name"><i class="fa fa-envelope "></i></label>
                            <input type="email" name="email2" id="name" placeholder="Email" value="{{ Input::old('email2') }}" required style="width: 75%"></div>
                        <div style="display: inline-block; clear: left; width: 100%"><label id="icon" for="name"><i class="fa fa-phone"></i></label>
                            <input type="text" name="contact2" id="name" placeholder="Contact" value="{{ Input::old('contact2') }}" required style="width: 75%"></div>
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
            $('#other_city').slideUp().prop('required', false);
            $('.centre').slideUp()
            $('#centre').prop('required', false);
            $('.other_school').slideUp().prop('required', false);
            $("#city").prop("disabled", !$('#state').val());
            var city = "{{ route('getcities') }}";
            $.ajax({
                url: city,
                method: 'post',
                data: {state: $(this).val()},
                success: function(result) {
                    $('#city').html(result+'<option value="other">Other</option>');
                }
            })
        });

        $('#city').change(function () {
            if($('#city').val() === "other") {
                $('#other_city').slideDown().prop('required', true);
                $('.centre').slideDown()
                $('#centre').prop('required', true);
                $('#school').val("other");
                $('#school').prop("disabled", 1);
                $('.other_school').slideDown().prop('required', true);
            }
            else {
                if($('#city').val() === "") {
                    $('.centre').slideUp()
                    $('#centre').prop('required', false);
                }
                else {
                    var creppresent="{{ route('cityrep_present') }}";
                    $.ajax({
                        url: creppresent,
                        method: 'post',
                        data: {city: $(this).val()},
                        success: function(result) {
                            if(result>0) {
                                $('.centre').slideUp()
                                $('#centre').prop('required', false);
                            }
                            else {
                                $('.centre').slideDown()
                                $('#centre').prop('required', true);
                            }
                        }
                    })
                }
                $('#other_city').slideUp().prop('required', false);
                $('.other_school').slideUp().prop('required', false);
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
            }
        });

        $('#school').change( function () {
            if($(this).val() === "other") {
                $('.other_school').slideDown().prop('required', true);
            }
            else {
                $('.other_school').slideUp().prop('required', false);
            }
        });
    </script>
@endsection