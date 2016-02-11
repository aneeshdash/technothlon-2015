@extends('layouts.master')
@section('title')
Technothlon | Registraion
@endsection
@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('sprites/registrations.css') }}">
@endsection
@section('description')
The interested students can register themselves for the examination online or offline. Technothlon is
        conducted over various cities and centers with the help of city representatives. The city
        representatives are responsible to collect the registrations offline. The registration fees is ₹100 per
        team. Participating schools can collect the registration fees themselves and then prepare a demand draft
        to be handed over to the city representatives.
        @endsection
@section('body')
<div class="container">
    <div class="sprite-registrations registrations-logo logo"></div>
    <div class="sprite-registrations registrations-title title"></div>
    <p>The interested students can register themselves for the examination online or offline. Technothlon is
        conducted over various cities and centers with the help of city representatives. The city
        representatives are responsible to collect the registrations offline. The registration fees is ₹100 per
        team. Participating schools can collect the registration fees themselves and then prepare a demand draft
        to be handed over to the city representatives.</p>
    <noscript>
        <blockquote>This page requires JavaScript for functioning.</blockquote>
    </noscript>
    <br>
</div>
<div class="container">
    <h2>Admit Cards</h2>
    <p>
        <a href="{{ route('admitcard') }}">Click Here</a> to download the hall ticket.<br>
        If you have not been allotted a centre yet, it will be updated soon or contact your city-representative.
    </p>
</div>
<div class="container">
    <h2>Offline Registration</h2>

    <p>The offline registration for Technothlon will be collected by various city
        representatives in their respective cities. In order to
        know about your city representative please select your city below.</p>

    <div style="text-align: center; margin: 32px 0;">
        <label>
            <span style="color: #d03100; font-weight: 300">Search your city</span><br>
            <select name="state" id="state">
                <option value="">Select State</option>
                @foreach(State::all() as $state)
                <option value="{{ $state->id }}">{{ $state->name }}</option>
                @endforeach
            </select>
            <select disabled id="city">
            <option value="">Select City</option>
            </select>
        </label>
        <div style="text-align: left" id="city-rep"></div>
    </div>
</div>
<div class="container" id="online_registration_form_container">
    <h2>Online Registration</h2>

    <p>
        Online registration for Technothlon 2015 is now open. <a href="{{ asset('register') }}" target="_blank">Click Here </a> to register.<br>
        Online registration closes on 15th July, 11:59:59 PM.
    </p><br>

    <div style="display: none" class="in-container" id="registered-data"></div>
</div>
<script type="text/javascript">
$(document).ready(function () {
});
$('#state').change(function () {
$('#city-rep').hide();
if($('#state').val() === "") {
$('#city').prop('disabled', 1);
}
else {
$('#city').prop('disabled', 0);
var city = "{{ route('citywcrep') }}";
                $.ajax({
                    url: city,
                    method: 'post',
                    data: {state: $(this).val()},
                    success: function(result) {
                        $('#city').html('<option value="">Select City</option>'+result);
                    }
                })
}
});

$('#city').change(function () {
if($('#city').val() !== "") {
var cityrep = "{{ route('getcityrep') }}";
                $.ajax({
                    url: cityrep,
                    method: 'post',
                    data: {city: $(this).val()},
                    success: function(result) {
                        $('#city-rep').html(result);
                    }
                })
$('#city-rep').show();
}
else {
$('#city-rep').hide();
}
});
</script>
@endsection