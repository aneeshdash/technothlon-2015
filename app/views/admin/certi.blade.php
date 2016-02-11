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

        .name {
            position: absolute;
            top: 520px;
            width: 100%;
            float: left;
            text-align: center;
        }
        .rank {
            position: fixed;
            top: 520px;
            width: 100%;
            float: left;
            text-align: center;
        }
        .squad {
            position: absolute;
            top: 520px;
            width: 100%;
            float: left;
            text-align: center;
        }
        div.page
        {
            page-break-after: always;
            page-break-inside: avoid;
        }
    </style>
</head>
<?php $result = Excel::load('certi.csv')->get(); ?>
@foreach($result as $users)
<div class="page">
    <div class="name">
        <h2>{{ $users->name }}</h2>
        <h3 style="position: absolute;top: 180px;left: 350px">{{ $users->rank }}</h3>
        <h3 style="position: absolute;top: 160px;left: 470px">{{ $users->squad }}</h3>
    </div>
<img src="{{ storage_path('files/certi/silver-certificate_2015.jpg') }}" style="width: 99%; height: 100%">
</div>
@endforeach
</html>