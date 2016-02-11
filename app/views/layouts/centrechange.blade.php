@extends('layouts.master')
@section('title')
    Centre Change
@endsection
@section('description')
    Centre Change
@endsection
@section('head')
    <!--<link rel="stylesheet" type="text/css" href="register.css"> -->
    <link rel="stylesheet" type="text/css" href="{{ asset('CSS/register.css') }}">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet' type='text/css'>
    {{--<link href="CSS/font-awesome.css" rel="stylesheet" type="text/css">--}}
    {{--<link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">--}}
    <link href="{{ asset("font-awesome-4.3.0/css/font-awesome.min.css") }}" rel="stylesheet" />
    <style>
        li {
            color: red;
        }
    </style>
@endsection
@section('body')
    <div class="container">
        <h1>Centre Change</h1>
        @if($errors->has())
            <h3 style="color: red">There are errors in the page please check all inputs again.</h3>
        @endif
        <div style="display: inline-block; width: 100%">
            <form id="register" action="{{ route('centrechange') }}" method="post">
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
            $("#city").prop("disabled", !$('#state').val());
            var city = "{{ route('citywcrep') }}";
            $.ajax({
                url: city,
                method: 'post',
                data: {state: $(this).val()},
                success: function(result) {
                    $('#city').html(result+'<option value="other">Other</option>');
                }
            })
        });
    </script>
@endsection