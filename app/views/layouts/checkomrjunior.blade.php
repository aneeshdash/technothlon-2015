<html>
<head>
    <style>
        input[type="text"], input[type="number"] {
            width:30px;
            background-color: #00dd00;
        }
    </style>
</head>
<body>
<form method="post" action="{{ route('checkomr') }}">
    <input type="text" name="roll" size="10" style="position: absolute; top: 170px; left: 80px;width: 100px">
    <input type="number" name="mobile" size="10" style="position: absolute; top: 170px; left: 380px;width: 100px">
    <input type="text" name="q1" size="1" style="position: absolute; top: 175px; left: 770px">
    <input type="text" name="q2" size="1" style="position: absolute; top: 195px; left: 770px">
    <input type="text" name="q3" size="1" style="position: absolute; top: 215px; left: 770px">
    <input type="text" name="q4" size="1" style="position: absolute; top: 245px; left: 770px">
    <input type="text" name="q5" size="1" style="position: absolute; top: 265px; left: 770px">
    <input type="text" name="q6" size="1" style="position: absolute; top: 295px; left: 770px">
    <input type="text" name="q7" size="1" style="position: absolute; top:330px; left: 770px">
    <input type="text" name="q8" size="1" style="position: absolute; top: 350px; left: 770px">
    <input type="text" name="q9" size="1" style="position: absolute; top: 370px; left: 770px">
    <input type="text" name="q10" size="1" style="position: absolute; top: 400px; left: 770px">
    <input type="text" name="q11" size="1" style="position: absolute; top: 420px; left: 770px">
    <input type="text" name="conf1" size="1" style="position: absolute; top: 460px; left: 30px">
    <input type="number" name="q12" size="1" style="position: absolute; top: 490px; left: 30px">
    <input type="number" name="q13" size="2" style="position: absolute; top: 450px; left: 170px">
    <input type="number" name="q14" size="2" style="position: absolute; top: 450px; left: 230px">
    <input type="text" name="q15" size="1" style="position: absolute; top: 500px; left: 770px">
    <input type="text" name="q16" size="1" style="position: absolute; top: 520px; left: 770px">
    <input type="number" name="q17" size="2" style="position: absolute; top: 450px; left: 310px">
    <input type="text" name="conf2" size="1" style="position: absolute; top: 430px; left: 390px">
    <input type="number" name="q18" size="2" style="position: absolute; top: 450px; left: 440px">
    <input type="number" name="q19" size="2" style="position: absolute; top: 450px; left: 480px">
    <input type="number" name="q20" size="2" style="position: absolute; top: 450px; left: 530px">
    <input type="text" name="q21" size="1" style="position: absolute; top: 550px; left: 770px">
    <input type="text" name="q22" size="1" style="position: absolute; top: 570px; left: 770px">
    <input type="text" name="23" size="1" style="position: absolute; top: 590px; left: 770px">
    <input type="text" name="q24" size="1" style="position: absolute; top: 610px; left: 770px">
    <input type="hidden" name="id">
    <input type="submit" style="position: fixed; top: 50px; left: 850px">
</form>
<img src="{{ asset('Scan\Original\HE\Ajmer\techno-omr-0367.bmp') }}">
</body>
</html>