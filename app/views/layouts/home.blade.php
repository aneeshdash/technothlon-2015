@extends('layouts.master')
@section('body')
    <div class="container">
        <h3>Recent Updates:</h3>
        <ul>
            <li>Prelims result has been declared. Check you results <a href="{{ route('result') }}">here</a>.</li>
            <li>Registration process for all KVs and JNVs are different. They need not register online.</li>
            {{--<li>You can retrive your roll number and password from <a href={{ route('rollrecover') }}> here</a></li>--}}
            <li>Technopedia has started.</li>
            <li>Online registration for Technothlon 2015 is now open.</li>
            <li>Find your City Representative details at:  <a href="{{ asset('registrations') }}">http://technothlon.techniche.org/registrations</a></li>
        </ul>
    </div>        <div class="container">

        <div style="margin-bottom: -38px; text-align: right">
            <a href="http://facebook.com/technothlon.techniche" target="_blank" class="fade" style="margin: 0 4px">
                <div class="sprite-home facebook"></div>
            </a>
            <a href="http://google.com/+technothlon" class="fade" target="_blank" style="margin: 0 4px">
                <div class="sprite-home gplus"></div>
            </a>
            <a href="http://technothlon.tumblr.com" class="fade" target="_blank" style="margin: 0 4px">
                <div class="sprite-home tumblr"></div>
            </a>
        </div>
        <div class="sprite-home mascot logo"></div>
        <div class="sprite-home technothlon-title title"></div>
        <div style="height: 32px"></div>
        <p> Technothlon is an international school championship
            organized by the student fraternity of Indian Institute of Technology Guwahati. Technothlon began its
            journey in 2004 with an aim to ‘Inspire Young Minds’. Starting on its journey with a participation of
            200 students confined to the city of Guwahati, over the past 11 years Technothlon has expanded its reach
            to over 200 cities all over the nation and various centers abroad. Through a series of events involving
            mental aptitude, logic, and dexterity, it seeks to provide school students a platform to build
            fundamental experience and knowledge, to exercise co-ordination skills, and to think out of the box. As
            its preliminary round is conducted through several centers in India, it is a competitive test of
            critical thinking. Its final stage is conducted in IIT Guwahati during Techniche.
        </p>
        <div style="height:32px"></div>
        <p><a href="{{ route('downloads') }}">Download</a> last years' papers.</p>        </div>
    <div class="container" style="text-align: center;overflow: hidden">
        <h3 style="color: #cd0a0a">Partners</h3>
        <div style="overflow: hidden;width: 100%;text-align: center">
        <div style="text-align:center;display: inline-block;clear:both;margin-left: 5px">
            <a href="http://topperlearning.com" target="_blank"><img src="{{ asset('images/partners/topper.jpg') }}" style="max-height: 120px"></a>
            <p style="font-size:14px; text-align: center">Strategic Media Partner</p>
        </div>
        <div style="text-align:center;display: inline-block;clear:both;margin-left: 5px">
            <a href="http://http://avantifellows.org/" target="_blank"><img src="{{ asset('images/partners/avanthi.jpg') }}" style="max-height: 100px"></a>
            <p style="font-size:14px; text-align: center">Events Sponsor</p>
        </div>
    </div>
    </div>
@endsection