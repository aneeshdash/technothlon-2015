<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Technothlon Admit Card</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
{{--    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />--}}
    <style>
        table {
            font-size: 14px;
            text-align: left;
        }
        @page { margin: 10px }

        th {
            vertical-align: top;
            text-align: left;
        }

        hr {
            border: 0;
            border-bottom: 1px dashed #ccc;
            background: #999;
            margin-top: 5px;
            margin-bottom: 15px;
        }

        p {
            margin: 1px;
        }

        ol {
            margin: 1px 0px;
            padding-left: 0px;
            font-family: Times;
            font-style: italic;
            font-size: 13px;
        }
    </style>
</head>
<body>
@foreach(User::where('school_id',$school)->where('paid',1)->get() as $user)
    <?php
            $pass = str_random(6);
            $user->result_pass = Crypt::encrypt($pass);
            $user->save();
    ?>
<div style="width: 790px; word-wrap: break-word">
    <div style="width: 49%;float: left;text-align: center;">
        <img src="{{ asset('images/technothlon.png') }}" style="width: 300px">
        <table>
            <tr>
                <th>Team</th>
                <th>:</th>
                <td> {{ ucwords(strtolower($user->name1)) }} & {{ ucwords(strtolower($user->name2)) }}</td>
            </tr>
            <tr>
                <th>Roll Number</th>
                <th>:</th>
                <td> {{ $user->roll }}</td>
            </tr>
            <tr>
                <th>Squad</th>
                <th>:</th>
                <td> {{ $user->squad }}</td>
            </tr>
            <tr>
                <th>Medium</th>
                <th>:</th>
                <td> @if($user->language == 'en') English @else Hindi @endif</td>
            </tr>
            <tr>
                <th>Timing</th>
                <th>:</th>
                <td>19th July, 2015, 10:30am - 1:00pm</td>
            </tr>
            <tr>
                <th>Centre</th>
                <th>:</th>
                <td><strong> ({{ $user->centre->code }}){{ $user->centre->name }}</strong><br>
                    {{ $user->centre->address }}<br>
                    {{ $user->centre->city->name }},{{ $user->centre->city->state->name }}</td>
            </tr>
        </table>
    </div>
    <div style="width: 49%;float: left">
        <div style="width: auto">
            <table style="border: solid;border-width: 2px">
                <tr>
                    <th colspan="3" style="text-align: center"><u>Result</u></th>
                </tr>
                <tr>
                    <th>Link</th>
                    <th>:</th>
                    <td>http://technothlon.techniche.org/result</td>
                </tr>
                <tr>
                    <th>Password</th>
                    <th>:</th>
                    <td>{{ $pass }}</td>
                </tr>
                <tr>
                    <td colspan="3"><i>Password is different from the one used for technopedia.</i></td>
                </tr>
            </table>
        </div>
        <p style="text-align: center"><b><u>Instructions</u></b></p>
        <ol>
            <li>The admit card must be presented for verification to the invigilator or any other authorized person.</li>
            <li>The candidates must carry their School Identity Card to the examination hall.</li>
            <li>The candidates should report to the examinaiton hall by 9:30am.</li>
            <li>The candidates must bring a black ball point pen to the examination centre.</li>
            <li>The hall ticket must be preserved even after the examinaiton as it contains password required to access result.</li>
        </ol>
    </div>
</div>
<div style="clear: both"><hr></div>
@endforeach
</body>
</html>