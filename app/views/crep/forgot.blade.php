@extends('layouts.master')
@section('title')
    CityRep | Login
@endsection
@section('description')
    CityRep | Login
@endsection
@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('CSS/technopedialogin.css') }}">
@endsection
@section('body')
    <div class="wrap">
        <div class="avatar">
            <img src="{{ asset('images/mascot.png') }}">
        </div>
        <form method="post">
            <input type="email" name="email" value="{{ Input::old('email') }}" placeholder="Email ID" required style="text-align: center; font-size: 32px">
            <div class="bar">
                <i></i>
            </div>
            <p style="color: darkred; text-align: center">@if(Session::has('error')){{ Session::get('error') }}@endif</p>
            <div style="text-align: center; width: 100%; margin-top: 10%">
                <input type="submit" value="Submit" style="width: 30%">
            </div>
        </form>
        <br><br>
    </div>
@endsection