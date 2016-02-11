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
<!--<div class="container">
    <h2>Print Hall Ticket</h2>

    <div class="in-container">
        <form id="hall-ticket-login" action="/technopedia/login" method="post" data-location="/technopedia/login">
            <label>
                Roll Number/Username <input type="text" name="username">
            </label><br>
            <label>
                Password <input type="password" name="password">
            </label><br>
            <div style=" margin-bottom: 4px">    <div id="captcha-box-technopedia-login"
         style="width: 300px; height: auto; display: inline-block; padding: 4px; background: #000000; border-radius: 2px 2px; border: 1px solid #000000; box-shadow: 0 0 2px 0 #003442">
        <div style="display: block; position: relative; left: 0; margin: 0">
            <a id="recaptcha_reload_btn"
               style="display: inline-block; float: right; margin-right: 6px; margin-top: -4px; position: absolute; top: 0; right: 0; border: 0; cursor: pointer; font-size: 0.55rem"
               onclick="newCaptcha()">refresh</a>
            <img id="technopedia-login-recaptcha-image" src="/resource/captcha/image?ref=technopedia-login"
                 style="width: 300px; height: 100px">
        </div>
        <div>
            <input type="hidden" autocomplete="off" value="" form="hall-ticket-login"
                   id="recaptcha_challenge_field"
                   name="recaptcha_challenge_field">
            <input form="hall-ticket-login" autocomplete="off"
                   style="width: 284px; max-width: 300px !important; margin:0"
                   type="text"
                   id="technopedia-login_recaptcha_response_field" name="technopedia-login_recaptcha_response_field" placeholder="Type the text"
                   required="required">
        </div>
    </div>
    <p class="error hall-ticket-login" id="error-technopedia-login-error-captcha"></p>
    <script>
        function newCaptcha() {
            $('#technopedia-login-recaptcha-image').attr('src', '/resource/captcha/image?ref=technopedia-login');
        }
    </script>
</div>
            <input type="submit" value="Login">
        </form>
        <br>
        <p style="font-size: 0.6rem">
            If you don't know you roll number and password, call your city representative. Search your city for list of
            representatives in your city.
        </p>
    </div>
</div>-->
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
        Online registration for Technothlon 2015 is now open. <a href="{{ asset('register') }}" target="_blank">Click Here </a> to register.
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