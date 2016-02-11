<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ School::find($school)->name }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
{{--    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />--}}
    <style>
        table {
            font-size: 10px;
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

        div.page
        {
            page-break-after: always;
            page-break-inside: avoid;
        }
    </style>
</head>
<body>
<div class="page">
<?php
        $i = 0;
    ?>
@foreach(User::where('school_id',$school)->where('paid',1)->take(1)->get() as $user)
    <?php
            $pass = Crypt::decrypt($user->result_pass);
    ?>
        <table style=" border-bottom: 1px dashed #000; padding: 16px 8px; page-break-inside: avoid; text-transform: capitalize !important">
            <tbody>
            <tr>
                <td style="vertical-align:top">
                    <table>
                        <tbody>
                        <tr>
                            <th style="text-align: center" colspan="2"><img height="67" width="300" title="" alt="" src="http://technothlon.techniche.org/images/technothlon-nav-logo.png"></th>
                        </tr>
                        <tr>
                            <td style="width: 98px"><strong>Team:</strong></td>
                            <td style="width: 300px">{$name[0]} & {$name[1]}</td>
                        </tr>
                        <tr>
                            <td style="width: 98px"><strong>Roll Number:</strong></td>
                            <td style="width: 300px">{$roll}</td>
                        </tr>
                        <tr>
                            <td style="width: 98px"><strong>Medium:</strong></td>
                            <td style="width: 300px">{$lang} ({$squad})</td>
                        </tr>
                        <tr>
                            <td style="width: 98px"><strong>Examination:</strong></td>
                            <td style="width: 300px">13 July 2014, 10:30 am - 01:00 pm</td>
                        </tr>
                        <tr>
                            <td style="width: 98px; vertical-align: top"><strong>Centre:</strong></td>
                            <td style="width: 300px">{$centreName}, {$centreAddress}</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="width: 350px"><p style="font-size: 9px"><strong>Instructions:</strong><br>
                                    &bull; The candidate must keep this hall ticket at the time of Examination and present on<br>
                                    &nbsp; demand to the invigilator or any other person authorized on this behalf.</p>
                            </td>
                        </tr>
                        </tbody></table>
                </td>
                <td style="vertical-align:top">
                    <table>
                        <tbody>
                        <tr>
                            <td style="width: 80px"><strong>Password:</strong></td>
                            <td style="width: 300px">abcdef</td>
                        </tr>
                        <tr>
                            <td style="width: 80px"><strong>Result:</strong></td>
                            <td style="width: 300px"><em>http://technothlon.techniche.org/results</em><br><br>or scan the QR code</td>
                        </tr>
                        <tr>
                            <td colspan="2"><p style="font-size: 9px"><br>
                                    &bull; The candidate should report at the centre by 09.30 a.m.<br>
                                    &bull; The candidate must bring a black ball point pen to the examination centre.<br>
                                    &bull; The candidate is required to keep the hall ticket safely even after the exam as the<br>
                                    &nbsp; password mentioned here is required to get access to the result.</p></td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
<div style="clear: both"><hr></div>
    <?php $i += 1; ?>
    @if($i % 4 == 0)
    </div><div class="page">
    @endif
@endforeach
</div>
</body>
</html>