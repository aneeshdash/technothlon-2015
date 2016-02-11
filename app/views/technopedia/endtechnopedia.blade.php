@extends('layouts.master')
@section('title')
    Technopedia
@endsection
@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('sprites/technopedia.css') }}">
@endsection
@section('description')
    Technopedia is the online module of Technothlon providing its students with an ultimate experience of the
    prelims beforehand. With the monthly quizzes, Technopedia aims at keeping the young minds involved in
    brainstorming questions and helping them prepare for the prelims. Only the students who have registered
    for Technothlon may log into Technopedia using either their email id or their roll number and
    password.
@endsection
@section('body')
    <div class="container">
        <div class="sprite-technopedia technopedia-logo logo"></div>
        <div class="sprite-technopedia technopedia-title title"></div><br>
        <div id="image" style="display: inline-block;height: 200px">
            <img src="{{ asset('images/mascot.png') }}"; style="height: 200px">
        </div>
        <div style="display: inline-block">
            Congratulations {{ Auth::user()->name1 }} & {{ Auth::user()->name2 }} , <br>
            You have attempted technopedia for this month and
            your score is {{ Session::get('score') }}.<br>
            Technopedia is held from 15th of one month till the 10th of the next month.<br>
            Do attempt the next Technopedia.<br>
            Leader Board of Technopedia will be announced on 13th of every month.
        </div>
    </div>
@endsection