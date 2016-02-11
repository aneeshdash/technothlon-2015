@extends('layouts.master')
@section('title')
    Admit Card | Technothlon
    @endsection
@section('description')
    Admit Card | Technothlon
    @endsection
@section('head')
        <link rel="stylesheet" type="text/css" href="{{ asset('CSS/technopedialogin.css') }}">
    @endsection
@section('body')
        <div class="container" style="text-align: center">
            {{ Auth::user()->get()->name1 }} & {{ Auth::user()->get()->name2 }}<br><br>
            {{ $text }}<br><br>
            @if(Auth::user()->get()->centre_id != null && Auth::user()->get()->paid == 0)
                <div style="text-align: left">
                Given below are the centres in your city. <br>
                If you want to change the centre, please contact your city representative. <br>
                The decision of city representative in this matter will be final.<br>
                <ul>
                    @foreach(Centre::where('city_id',Auth::user()->get()->centre_city/10)->get() as $centre)
                        <li>{{ $centre->name }}</li>
                        @endforeach
                </ul>
                </div>
                @endif
        </div>
    @endsection