@extends('layouts.master')
@section('title')
    Technopedia | Previous Questions
@endsection
@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('sprites/faqs.css') }}">
@endsection
@section('description')
Technopedia Previous Questions
@endsection
@section('body')
<div class="container">
    <h1 style="text-align: center">
            <span style="color: #d03100">Previous Technopedia Questions</span>
    </h1>

    <div class="in-container" style="text-align: left; margin-left: 30%">
        <table>
            <tr><td><a href="{{ route('test','january') }}">January</a></td></tr>
            <tr><td><a href="{{ route('test','february') }}">February</a></td></tr>
            <tr><td><a href="{{ route('test','march') }}">March</a></td></tr>
            <tr><td><a href="{{ route('test','april') }}">April</a></td></tr>
            <tr><td><a href="{{ route('test','may') }}">May</a></td></tr>
            <tr><td><a href="{{ route('test','june') }}">June</a></td></tr>
        </table>
        <br>
        </div>
    </div>
    @endsection
