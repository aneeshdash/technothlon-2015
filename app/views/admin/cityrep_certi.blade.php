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
            top: 530px;
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
    {{--@foreach(DB::table('cityrep_certi')->get() as $crep)--}}
        {{--<div class="page">--}}
            {{--<div class="name">--}}
                {{--<h2>{{ $crep->name }}</h2>--}}
                {{--<h2 style="margin-top: 130px">{{ $crep->city }}</h2>--}}
            {{--</div>--}}
            {{--<img src="{{ storage_path('files/certi/cityrep_certi.jpg') }}" style="width: 99%; height: 100%">--}}
        {{--</div>--}}
        {{--@endforeach--}}
    @for($i=1;$i<2;$i++)
        <div class="page">
            <div class="name">
                {{--<h2 style="margin-top: 30px;">__________________________________</h2>--}}
                {{--<h2 style="margin-top: 140px">______________________________ </h2>--}}
            </div>
            <img src="{{ storage_path('files/certi/volunteer_certi.jpg') }}" style="width: 99%; height: 100%">
        </div>
        @endfor
</html>