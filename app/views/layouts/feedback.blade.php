@extends('layouts.master')
@section('title')
    Technothlon | Feedback
    @endsection
@section('decsription')
    Help us improve.
    @endsection
@section('head')
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('CSS/register.css') }}">--}}
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet' type='text/css'>
    <link href="{{ asset("font-awesome-4.2.0/css/font-awesome.min.css") }}" rel="stylesheet" />
    @endsection
@section('body')
    <div class="container">
    <h1 style="text-align: center">Technothlon Feedback</h1><br>
    <p>We welcome your feedback about our current examination features and suggestions on how we can improve our support in the future.Let us know your views and comments on the box below.</p><br>
        <div class="in-container">
    <form method="post" action="{{ route('feedback') }}">
        <label id="icon" for="name"><i class="fa fa-user"></i></label>
            <input type="text" name="name" id="name" placeholder="Name" required value="{{ Input::old('name') }}" style="width: 30%">
        <label id="icon" for="name" style="margin-left: 5%"><i class="fa fa-envelope "></i></label>
            <input required type="email" name="email" id="name" placeholder="Email" value="{{ Input::old('email') }}" style="width: 30%"><br>
        <p>Suggestion: </p>
        <textarea required name="suggestion" style="width: 60%; height: 200px; font-size: large" placeholder="Write your suggestions here."></textarea><Br>
        <input type="submit" value="Send">
    </form>
        </div>
    </div>
    @endsection