@extends('layouts.master')
@section('title')
    Technothlon
    @endsection
@section('body')
    <a href="{{ route('logout') }}" style="position: absolute; left: 73%; top: 15%">Logout</a>
    <div class="container">
        {{ Auth::user()->get()->name1 }} & {{ Auth::user()->get()->name2 }}<br><br>
        Dowload your certificates by clicking the links below:<br>
        <ol>
            <li><a href="{{ route('certificatedownload',Auth::user()->get()->squad.'/'.Crypt::encrypt(Auth::user()->get()->name1.str_pad(strval($rank), 6, "0", STR_PAD_LEFT))) }}">{{ Auth::user()->get()->name1 }}</a> </li>
            <li><a href="{{ route('certificatedownload',Auth::user()->get()->squad.'/'.Crypt::encrypt(Auth::user()->get()->name2.str_pad(strval($rank), 6, "0", STR_PAD_LEFT))) }}">{{ Auth::user()->get()->name2 }}</a> </li>
        </ol>
    </div>
    @endsection