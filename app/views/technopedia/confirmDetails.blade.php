@extends('layouts.master')
@section('title')
    Details Confirmation
@endsection
@section('description')
    Details Confirmation
@endsection
@section('head')
    <!--<link rel="stylesheet" type="text/css" href="register.css"> -->
    <link rel="stylesheet" type="text/css" href="{{ asset('CSS/register.css') }}">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet' type='text/css'>
    {{--<link href="CSS/font-awesome.css" rel="stylesheet" type="text/css">--}}
    {{--<link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">--}}
    <link href="{{ asset("font-awesome-4.3.0/css/font-awesome.min.css") }}" rel="stylesheet" />
@endsection
@section('body')
     <div class="container">
            <h1>Details Confirmation</h1>
         <h3>Note: The names can be edited only once. Please fill the correct names of both participants as these names will appear on certificates and no more request for editing will be entertained.</h3>
            <div>
                <form id="register" action="{{ route('confdetails') }}" method="post">
                    <div style="display: inline-block; width: 100%; margin-top: 2%">
                        <hr>
                        <div style="display: inline-block; width: 45%">
                            <h2 align="center">Participant 1</h2>
                            <div style="display: inline-block; width: 100%">
                                <div style="display: inline-block; clear: left; width: 100%"><label id="icon" for="name"><i class="fa fa-user"></i></label>
                                    <input type="text" name="name1" id="name" placeholder="First Name" required value="{{ Auth::user()->get()->name1 }}" style="width: 75%"></div>
                            </div>
                        </div>
                        <div style="display: inline-block; width: 45%">
                            <h2 align="center">Participant 2</h2>
                            <div style="display: inline-block; clear: left; width: 100%"><label id="icon" for="name"><i class="fa fa-user"></i></label>
                                <input type="text" name="name2" id="name" placeholder="First Name" value="{{ Auth::user()->get()->name2 }}" required style="width: 75%"></div>
                        </div>
                    </div>
                    <div style="display: inline-block; width: 100%">
                        <div class="center" style="margin-top: 50px">
                            <!--<a href="" class="button" onclick="document.register.submit()">Register</a>-->
                            <input type="submit" value="Submit" style="padding: 6px">
                        </div></div>
                </form>
            </div>
        </div>

    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
@endsection