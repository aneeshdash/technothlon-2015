<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<div style="display: table; margin: 0 auto">
    <div style="text-align: center">
        <img src="http://technothlon.techniche.org/images/technothlon.png"; width="300px">
    </div><br><br>
    <div style="display: inline-block">
        Dear {{ $name }},<br>
        You have successfully registered for Technothlon 2015 with the following details: <br><br>
        <div id="school">
            <div style="display: inline-block">
                <div>
                    School Name:
                </div>
                <div>
                    School Address:
                </div>
                <div>
                    City:
                </div>
                <div>
                    State
                </div>
            </div>
            <div style="display: inline-block; margin-left: 10px">
                <div>
                    {{ $school->name }}
                </div>
                <div>
                    {{ $school->address }}
                </div>
                <div>
                    {{ $city->name }}
                </div>
                <div>
                    {{ $state->name }}
                </div>
            </div>
        </div>
        <div><br>
            <div style="display: inline-block">
                Squad: {{ $user->squad }}
            </div>
            <div style="display: inline-block; margin-left: 20px">
                Medium: {{ $user->language }}
            </div>
        </div><br>
        <div id="details">
            <div style="display: inline-block">
                <div style="display: inline-block">
                    <div>
                        Name:
                    </div>
                    <div>
                        Email:
                    </div>
                    <div>
                        Contact:
                    </div>
                </div>
                <div style="display: inline-block; margin-left: 10px">
                    <div>
                        {{ $user->name1 }}
                    </div>
                    <div>
                        {{ $user->email1 }}
                    </div>
                    <div>
                        +91{{ $user->contact1 }}
                    </div>
                </div>
            </div>
            <div style="display: inline-block; margin-left: 20px">
                <div style="display: inline-block">
                    <div>
                        Name:
                    </div>
                    <div>
                        Email:
                    </div>
                    <div>
                        Contact:
                    </div>
                </div>
                <div style="display: inline-block; margin-left: 10px">
                    <div>
                        {{ $user->name2 }}
                    </div>
                    <div>
                        {{ $user->email2 }}
                    </div>
                    <div>
                        +91{{ $user->contact2 }}
                    </div>
                </div>
            </div>
        </div>
    </div><br><br><br><br>
    <div id="roll">
        Given below is your roll number and password which will be required for accessing technopedia<br> and other features of Technothlon.<br><br>
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
                <li>The hall ticket can be downloaded from our website one week prior to the examination.</li>
                <li>You will need to submit the registration fees of Rs. 100 on the day of exam.</li>
                <li>Your examination centre will be printed on  your hall ticket and will be located in your city<br> unless there are no city representative in your city and you were prompted to choose another city</li>
                <li>If your school details were absent during registration then you will receive an email upon verification of your school details.</li>
                <li>Technopedia starts from the 15th of every month.</li>
            </ul>
        </div>
    </div>
</div>
</body>
</html>