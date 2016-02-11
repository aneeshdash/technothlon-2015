@extends('layouts.master')
@section('title')
    Technothlon | 404
@endsection
@section('body')
    <div class="container">
        <div style="height: 100%">
        <div style="height: 100%; display: inline-block">
            <img src="{{ asset('images/404.png') }}" alt="" />
        </div>
        <div style="display: inline-block; margin-top: 10%; margin-left: 5%; position: absolute">
            <p style="text-align: center">The page you are looking for is not available. <br>If you think it should work please <a href="{{ route('home') }}"> report us.</a></p>
        </div>
    </div>
    </div>
@endsection