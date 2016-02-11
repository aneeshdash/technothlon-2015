@extends('layouts.master')
@section('body')
<div class="container" xmlns="http://www.w3.org/1999/html">
<p>Hello {{$user->name1}} & {{$user->name2}} !<br>
    Your roll number is {{$user->roll}}<br>
    You are registered with the following email ids:<br>
    Email1:{{$user->email1}}<br>
    Email2:{{$user->email2}}<br>
    <input type="button" value="Both e-mail ids are correct" id="0">
    <input type="button" value="Email 1 is correct" id="1">
    <input type="button" value="Email 2 is correct" id="2"><br><br>
    P.S. : For any corrections, send a mail to <a href="mailto:technothlon@techniche.org" target="_blank">technothlon@techniche.org</a> with the following details:<br>
    <ul style="margin-left: 10%">
    <li>Your Names and roll number(if applicable)</li>
    <li>Registered School Name</li>
    <li>City, State</li>
    <li>Please send the mail from the e-mail id you intended registered with</li>
    </ul>
    </p>
</div>
<script>
$('input').click(function() {
    var url="{{ route('rollmail') }}";
    var id="{{$user->id}}";
                        $.ajax({
                            url: url,
                            method: 'post',
                            data: {type: $(this).attr('id'), id: id},
                            success: function(result) {
                                alert("Email has been sent to the correct email-ids.\n Also check your spam folder for mail.\nRead other contents of page before pressing 'OK' as page will change.");
                                window.location = "{{ route('home') }}";
                            }
                        })
});
</script>
@endsection