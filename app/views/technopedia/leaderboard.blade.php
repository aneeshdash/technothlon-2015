@extends('layouts.master')
@section('title')
    Technopedia | Leaderboard
    @endsection
@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('CSS/leaderboard.css') }}">
    @endsection
@section('body')
    <div class="container">
    <h1 style="text-align: center">Technopedia Leaderboard</h1>
        <p>*Multiple registrations and attempt from same students for technopedia was found. They were deleted. If such cases are found again then their registrations will be cancelled.</p>
        {{ $table }}
    </div>
    @endsection