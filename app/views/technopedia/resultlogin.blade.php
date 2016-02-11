@extends('layouts.master')
@section('title')
    Result | Login
    @endsection
@section('description')
    Result | Login
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
            <input type="text" name="roll" value="{{ Input::old('roll') }}" placeholder="Roll Number" required style="text-align: center; font-size: 32px">
            <div class="bar">
                <i></i>
            </div>
            <input type="password" name="password" placeholder="Password" required style="text-align: center; font-size: 32px; font-family: 'FontAwesome', sans-serif">
            <p style="text-align: center"><a href="{{ route('forgot') }}" style="font-size: 15px; color: #3a57af; margin-top: 1%">Forgot Password ?</a></p>
                <p style="color: darkred; text-align: center">@if(Session::has('error')){{ Session::get('error') }}@endif</p>
            <div style="text-align: center; width: 100%; margin-top: 10%">
            <input type="submit" value="Sign In" style="width: 30%">
            </div>
            </form>
            <br><br>
        </div>
    @endsection