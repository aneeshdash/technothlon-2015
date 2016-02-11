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

    <p>Technopedia is the online module of Technothlon providing its students with an ultimate experience of the
        prelims beforehand. With the monthly quizzes, Technopedia aims at keeping the young minds involved in
        brainstorming questions and helping them prepare for the prelims. Only the students who have registered
        for Technothlon may log into Technopedia using either their email id or their roll number and
        password.</p>
    <br>

    <p>Technopedia starts from 15th of every month, till then you can practice
        <a href="https://www.facebook.com/hashtag/technocoupdoeil" target="_blank">Techno Coup D'œil</a>, a
        weekly question series running on social media
        <a href="http://facebook.com/technothlon.techniche" target="_blank">Facebook</a>,
        <a href="http://google.com/+technothlon" target="_blank">Google+</a> and
        <a href="http://technothlon.tumblr.com" target="_blank">Blog</a>.</p>
    <br>

    <div id="technopedia-menu" style="text-align: center; font-weight: bolder!important;">
        <a class="links fade">
            <div>
                <div class="block-logo sprite-technopedia leaderboard"></div>
                <div class="block-text">Leader Board</div>
            </div>
        </a>
        <a href="{{ route('starttechnopedia') }}" class="links fade">
            <div>
                <div class="block-logo sprite-technopedia quiz"></div>
                <div class="block-text">Monthly Quiz</div>
            </div>
        </a>
        <a class="links fade" target="_blank"
           href="http://www.facebook.com/sharer/sharer.php?s=100&p[url]=http://technothlon.techniche.org/technopedia/&p[images][0]=http://technothlon.techniche.org/content/images/technopedia-logo.png&p[title]=Technothlon+-+Try+Technopedia&p[summary]=Technopedia+is+the+online+module+of+Technothlon+providing+its+students+with+an+ultimate+experience+of+the+prelims+beforehand.+With+the+monthly+quizzes%2C+Technopedia+aims+at+keeping+the+young+minds+involved+in+brainstorming+questions+and+helping+them+prepare+for+the+prelims.+Only+the+students+who+have+registered+for+Technothlon+may+log+into+Technopedia+using+either+their+email+id+or+their+roll+number+and+password.&rlz=1C5CHFA_enIN554IN554&oq=Technopedia+is+the+online+module+of+Technothlon+providing+its+students+with+an+ultimate+experience+of+the+prelims+beforehand.+With+the+monthly+quizzes%2C+Technopedia+aims+at+keeping+the+young+minds+involved+in+brainstorming+questions+and+helping+them+prepare+for+the+prelims.+Only+the+students+who+have+registered+for+Technothlon+may+log+into+Technopedia+using+either+their+email+id+or+their+roll+number+and+password.">
            <div>
                <div class="block-logo sprite-technopedia friend"></div>
                <div class="block-text">Refer a Friend</div>
            </div>
        </a>
        <a class="links fade">
            <div>
                <div class="block-logo sprite-technopedia previous"></div>
                <div class="block-text">Previous Quiz</div>
            </div>
        </a>
    </div>
    <br>
</div>
@endsection