@extends('layouts.master')
@section('title')
Technothlon | Videos
@endsection
@section('head')
<link rel="stylesheet" type="text/css" href="{{ asset('sprites/about.css') }}">
	<style>
		.img {
			display: inline-block;
			width: 30%;
			height: 20%;
			margin-bottom: 12px;
			border: 1px solid transparent;
			text-align: center;
			vertical-align: bottom;
			cursor: pointer;
		}

		.img div {
			min-height: 40px;
			vertical-align: bottom;
			display: inline-block;
			text-align: inherit;
			cursor: pointer;
		}

		.img > div {
			display: block;
		}
		.person {
			display: inline-block;
			min-width: 280px;
			margin-bottom: 72px;
			border: 1px solid transparent;
			text-align: left;
		}
	</style>
@endsection
@section('body')
<div class="container">
    <div style="text-align: center">
	<h1 style="color: #cd0a0a">Videos</h1>
	</div>
<div class="video" style="text-align: center">
	{{--<div style="width: 80%;margin-left: 10%">--}}
<iframe id="frame" width="560px" height="315px" src="https://www.youtube.com/embed/obOBPiM9Y2c" frameborder="1" allowfullscreen style="border: none"></iframe>
	{{--</div>--}}
<br><br>
</div>
<br><br><br>
	    <div class="img" id="https://www.youtube.com/embed/EMuqPrpzdGo"><img src="{{ asset('images/videos/hc.jpg') }}" width="100%" height="80%">
	<div class="name">HC Verma</div>
			</div>
	    <div class="img" id="https://www.youtube.com/embed/l82IYOjJybk"><img src="{{ asset('images/videos/t14.jpg') }}" width="100%" height="80%">
	<div class="name">T14</div>
	</div>
	    <div class="img" id="https://www.youtube.com/embed/P9YjIthmfa0"><img src="{{ asset('images/videos/imld.jpg') }}" width="100%" height="80%">
	<div class="name">International Mother Language Day</div>
	</div><br>
	    <div class="img" id="https://www.youtube.com/embed/nohoFGBUNAQ"><img src="{{ asset('images/videos/gcd.jpg') }}" width="100%" height="70%">
	<div class="name">National Girl Child Day</div>
	</div>
	    <div class="img" id="https://www.youtube.com/embed/qG-q2W_aRyI"><img src="{{ asset('images/videos/t15t.jpg') }}" width="100%" height="80%">
	<div class="name">Technothlon'15 official curtain raiser</div>
	</div>
	    <div class="img" id="https://www.youtube.com/embed/0uZK6vD_qfc"><img src="{{ asset('images/videos/t14t.jpg') }}" width="100%" height="80%">
	<div class="name">Technothlon'14 official curtain raiser</div>
	</div><br>
	<div class="img" id="https://www.youtube.com/embed/obOBPiM9Y2c"><img src="{{ asset('images/videos/btbc.jpg') }}" width="100%" height="80%">
		<div class="name">Blow the Ball Challenge</div>
	</div>
	</div>
<script>
$('.img').click(function() {
$('#frame').attr('src',$(this).attr('id'));
});
</script>
	@endsection
