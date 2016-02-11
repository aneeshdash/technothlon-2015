@extends('layouts.master')
@section('title')
    Technothlon
    @endsection
@section('body')
    <div class="container">
        <div id="image" style="display: inline-block;height: 200px">
            <img src="{{ asset('images/mascot.png') }}"; style="height: 200px">
        </div>
        <div style="display: inline-block">
            Congratulations {{ $user->name1 }} & {{ $user->name2 }}, <br>
            You have been successfully registered.<br>
            Your roll number is {{ $user->roll }}. <br>
            Please check your email for other details regarding the examination.<br><br>
        For any other query <a href="{{ route('contact') }}">contact us</a>.
        </div>
    </div>
    @endsection