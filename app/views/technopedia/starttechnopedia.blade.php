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
        <div class="sprite-technopedia technopedia-title title"></div>
        <h3>Rules:</h3>
        <ul>
            <li>A team can attempt Technopedia only once.</li>
            <li>It contains 10 questions.</li>
            <li>It ends when you give 3 incorrect answers.</li>
            <li>Do not close your browser once you start else you will not be able to attempt it.</li>
            <li>If the question number is 'n', then you are provided n^2 marks for correct answer and n marks are deducted for incorrect answer.</li>
        </ul>
        <form method="post" action="{{ route('question') }}" style="text-align: center">
            <input type="submit" value="Start">
        </form>
    </div>
    @endsection