@extends('layouts.master')
@section('body')
<div class="container">
<h3>Recent Updates:</h3>
    <ul>
        <li>Online registration for Technothlon 2015 is now open. <a href="{{ asset('register') }}" target="blank">Click Here </a> to register.</li>
        <li>Registration for Technothlon 2015 is now open.</li>
        <li>Find your City Representative details at:  <a href="{{ asset('registrations') }}">http://technothlon.techniche.org/registrations</a></li>
    </ul>
</div>
<div class="container">
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
@endsection