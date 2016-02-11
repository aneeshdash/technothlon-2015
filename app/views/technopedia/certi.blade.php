<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Technothlon Admit Card</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    {{--<link href='http://fonts.googleapis.com/css?family=Droid+Serif:700italic' rel='stylesheet' type='text/css'>--}}
    {{--    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />--}}
    <style>
        @page {
            margin: 0px;
        }

        div {
            position: absolute;
            top: 520px;
            width: 100%;
            float: left;
            text-align: center;
        }
    </style>
</head>
<div>
    <h2>{{ $name }}</h2>
    @if($rank < 251)
        <h3 style="position: absolute;top: 180px;left: 350px">{{ $rank }}</h3>
        <h3 style="position: absolute;top: 160px;left: 470px">{{ $squad }}</h3>
        @endif
</div>
@if($rank < 51)
        <img src="{{ storage_path('files/certi/gold-certificate_2015.jpg') }}" style="width: 99%; height: 100%">
    @elseif($rank < 251)
        <img src="{{ storage_path('files/certi/silver-certificate_2015.jpg') }}" style="width: 99%; height: 100%">
    @else
        <img src="{{ storage_path('files/certi/participation-certificate_2015.jpg') }}" style="width: 99%; height: 100%">
    @endif
</html>