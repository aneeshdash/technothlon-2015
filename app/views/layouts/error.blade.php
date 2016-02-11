@extends('layouts.master')
@section('head')
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('error/error.css') }}" media="all">
    @endsection
@section('description')
    Error!
    @endsection
@section('title')
    Error!
@endsection
@section('body')
    <!-----start-wrap--------->
    <div class="wrap">
        <!-----start-content--------->

            <!-----end-logo--------->
            <!-----start-search-bar-section--------->
            <div class="buttom">
                <div class="seach_bar">
                    <div class="content">
                        <!-----start-logo--------->
                        <div class="logo" style="margin-left: 0; width: 95%">
                            <h1><img src="{{ asset('error/error.png') }}"/></h1>
                            <span style="list-style:none;margin:0;padding:0;">Oops! There seems to be an error from the server.<br> Please try again later.</span>
                        </div>
                    <p>you can go to <span><a href="{{ route('home') }}">home</a></span> or <span><a href="javascript:history.go(-1)">return</a></span> to previous page</p>
                    <!-----start-sear-box--------->

                </div>
            </div>
            <!-----end-sear-bar--------->
        </div>
        <!----copy-right-------------->
    </div>

    <!---------end-wrap---------->
    @endsection