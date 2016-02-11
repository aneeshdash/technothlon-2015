@extends('layouts.master')
@section('title')
    Technothlon
    @endsection
@section('body')
    <a href="{{ route('logout') }}" style="position: absolute; left: 73%; top: 15%">Logout</a>
    <div class="container">
        @if(DB::table('results_2015')->where('roll',Auth::user()->get()->roll)->count() > 0)
            <?php
                $db = DB::table('results_2015')->where('roll',Auth::user()->get()->roll)->first();
                $rank = $db->rank;
            ?>
        @if($db->kv != 1)
            @if($rank <= 50)
            <div style="display: inline-block; width: 90%; ">
            <span style="color: #00a65a; font-size: 25px">Congratulations!!!</span> {{ Auth::user()->get()->name1 }} & {{ Auth::user()->get()->name2 }}, <br>
            Your <b>All India Rank is <span style="color: #0000FF">{{ $rank }}</span></b>.<br>
            You have been selected for Technothlon Mains.<br><br><br>
            You will be contacted shortly regarding Mains.<br>
            Mains will be held from 3rd - 6th September, 2015 during Techniche at IIT Guwahati.<br>
             <br>
        </div>
                @elseif($rank <= 250)
        <div style="display: inline-block; width: 90%; ">
            <span style="color: #00a65a; font-size: 25px">Congratulations!!!</span> {{ Auth::user()->get()->name1 }} & {{ Auth::user()->get()->name2 }}, <br>
            Your <b>All India Rank is <span style="color: #0000FF">{{ $rank }}</span></b>.<br>
            <br><br><br>
            Your Silver Certificates will be posted to your school address and the soft-copy will be available on our website from 10th September, 2015.<br>
            <br>
        </div>
                @elseif($rank <1000)
        <div style="display: inline-block; width: 90%; ">
            <span style="color: #00a65a; font-size: 25px">Congratulations!!!</span> {{ Auth::user()->get()->name1 }} & {{ Auth::user()->get()->name2 }}, <br>
            Your <b>All India Rank is <span style="color: #0000FF">{{ $rank }}</span></b>.<br>
            <br><br><br>
            To download your certificates click below:<br>
            <a href="{{ route('certi',Crypt::encrypt(Auth::user()->get()->name1)) }}">{{ Auth::user()->get()->name1 }}</a><br>
            <a href="{{ route('certi',Crypt::encrypt(Auth::user()->get()->name2)) }}">{{ Auth::user()->get()->name2 }}</a><br>
            <br>
        </div>
                @else
        <div style="display: inline-block; width: 90%; ">
            Dear {{ Auth::user()->get()->name1 }} & {{ Auth::user()->get()->name2 }}, <br>
            @if($db->roll[0] == 'J')
                Your percentile score is  {{ number_format((18000 - $rank)/180,2) }}.<br>
            @else
                Your percentile score is  {{ number_format((9000 - $rank)/90,2) }}<br>
            @endif
            <br><br><br>
            To download your certificates click below:<br>
            <a href="{{ route('certi','name1') }}">{{ Auth::user()->get()->name1 }}</a><br>
            <a href="{{ route('certi','name2') }}">{{ Auth::user()->get()->name2 }}</a><br>
            <br>
            <br>
        </div>
                @endif
            @else
                    <div style="display: inline-block; width: 90%; ">
                        <span style="color: #00a65a; font-size: 25px">Congratulations!!!</span> {{ Auth::user()->get()->name1 }} & {{ Auth::user()->get()->name2 }}, <br>
                        Your <b>All India Rank KV/JNV is <span style="color: #0000FF">{{ $rank }}</span></b>.<br>
                        <br>
                        @if($rank <= 10)
                            You have been selected for Technothlon Mains.<br>
                            You will be contacted shortly regarding Mains.<br>
                            Mains will be held from 3rd - 6th September, 2015 during Techniche at IIT Guwahati.<br>
                            @endif
                        <br><br><br>
                        To download your certificates click below:<br>
                        <a href="{{ route('certi','name1') }}">{{ Auth::user()->get()->name1 }}</a><br>
                        <a href="{{ route('certi','name2') }}">{{ Auth::user()->get()->name2 }}</a><br>
                        <br>
                        <br>
                    </div>
                @endif
        @else
        <div style="display: inline-block; width: 90%; ">
            Result not found.<br>
            Please <a href="{{ route('contact') }}">contact us</a>.
        </div>
            @endif
    </div>
    @endsection