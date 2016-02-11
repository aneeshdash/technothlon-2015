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
            {{ $user->name1 }} & {{ $user->name2 }}, <br>
            Your centre has been successfully changed.<br>
            Admit cards will be available on our website in a few days. <br><br>
        For any other query <a href="{{ route('contact') }}">contact us</a>.
        </div>
    </div>
    @endsection