<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Technopedia</title>
</head>
<body>
<div style="display: table; margin: 0 auto">
    <div style="text-align: center">
        <img src="technothlon.png"; width="300px">
    </div><br><br>
    <div style="display: inline-block">
        Dear {{ $name }},<br>
        You had requested for password reset. Give below is your new password: <br><br>

    </div><br><br>
    <div id="roll">
        <div style="display: inline-block;">
            <div>Roll Number:</div>
            <div>Password:</div>
        </div>
        <div style="display: inline-block;">
            <div>{{ $user->roll }}</div>
            <div>{{ $password }}</div>
        </div><br><br>
        <div id="details">
            <ul>
                <li>The exam is on 19th July, 2015.</li>
                <li>Technopedia starts from the 15th of every month and ends on the 10th of next month.</li>
                <li>The first Technopedia starts from January</li>
                <li>In case of any discrepancy, <a href="http://technothlon.techniche.org/contact" target="_blank">Contact Us</a>. </li>
            </ul>
        </div>
    </div>
</div>
</body>
</html>