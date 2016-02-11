<html>
<head>
    <style>
        input[type="text"], input[type="number"] {
            width:30px;
            background-color: #00dd00;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }

        input[type="number"]::-webkit-inner-spin-button,input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
</head>
<body>
<form method="post" action="{{ route('checkomr') }}">
    <input type="text" name="roll" autocomplete="off" size="10" style="position: absolute; top: 170px; left: 80px;width: 100px" value="{{ $data->roll }}">
    <input type="number" name="mobile" autocomplete="off" size="10" style="position: absolute; top: 170px; left: 380px;width: 100px" value="{{ $data->mobile }}">
    <input type="text" name="q1" size="1" style="position: absolute; top: 175px; left: 770px" value="{{ $data->q1 }}">
    <input type="text" name="q2" size="1" style="position: absolute; top: 195px; left: 770px" value="{{ $data->q2 }}">
    <input type="text" name="q3" size="1" style="position: absolute; top: 215px; left: 770px" value="{{ $data->q3 }}">
    <input type="text" name="q4" size="1" style="position: absolute; top: 245px; left: 770px" value="{{ $data->q4 }}">
    <input type="text" name="q5" size="1" style="position: absolute; top: 265px; left: 770px" value="{{ $data->q5 }}">
    <input type="text" name="q6" size="1" style="position: absolute; top: 295px; left: 770px" value="{{ $data->q6 }}">
    <input type="text" name="q7" size="1" style="position: absolute; top:330px; left: 770px" value="{{ $data->q7 }}">
    <input type="text" name="q8" size="1" style="position: absolute; top: 350px; left: 770px" value="{{ $data->q8 }}">
    <input type="text" name="q9" size="1" style="position: absolute; top: 370px; left: 770px" value="{{ $data->q9 }}">
    <input type="text" name="q10" size="1" style="position: absolute; top: 400px; left: 770px" value="{{ $data->q10 }}">
    <input type="text" name="q11" size="1" style="position: absolute; top: 420px; left: 770px" value="{{ $data->q11 }}">
    <input type="text" name="conf1" size="1" style="position: absolute; top: 460px; left: 30px" value="{{ $data->conf1 }}">
    <input type="number" name="q12" size="2" style="position: absolute; top: 490px; left: 30px" value="{{ $data->q12 }}">
    <input type="number" name="q13" size="2" style="position: absolute; top: 450px; left: 170px" value="{{ $data->q13 }}">
    <input type="number" name="q14" size="2" style="position: absolute; top: 450px; left: 230px" value="{{ $data->q14 }}">
    <input type="text" name="q15" size="1" style="position: absolute; top: 500px; left: 770px" value="{{ $data->q15 }}">
    <input type="text" name="q16" size="1" style="position: absolute; top: 520px; left: 770px" value="{{ $data->q16 }}">
    <input type="number" name="q17" size="2" style="position: absolute; top: 450px; left: 310px" value="{{ $data->q17 }}">
    <input type="text" name="conf2" size="1" style="position: absolute; top: 430px; left: 390px" value="{{ $data->conf2 }}">
    <input type="number" name="q18" size="2" style="position: absolute; top: 450px; left: 440px" value="{{ $data->q18 }}">
    <input type="number" name="q19" size="2" style="position: absolute; top: 450px; left: 480px" value="{{ $data->q19 }}">
    <input type="number" name="q20" size="2" style="position: absolute; top: 450px; left: 530px" value="{{ $data->q20 }}">
    <input type="text" name="q21" size="1" style="position: absolute; top: 550px; left: 770px" value="{{ $data->q21 }}">
    <input type="text" name="q22" size="1" style="position: absolute; top: 570px; left: 770px" value="{{ $data->q22 }}">
    <input type="text" name="q23" size="1" style="position: absolute; top: 590px; left: 770px" value="{{ $data->q23 }}">
    <input type="text" name="q24" size="1" style="position: absolute; top: 610px; left: 770px" value="{{ $data->q24 }}">
    <input type="hidden" name="id" value="{{ $data->id }}">
    <input type="submit" name="submit" value="Submit" style="position: fixed; top: 50px; left: 850px">
    <input type="submit" name="error" value="Error" style="position: fixed; top: 50px; left: 950px">
    <input type="submit" name="error" value="Not Scanned" style="position: fixed; top: 10px; left: 850px">
    <input type="submit" name="error" value="No School" style="position: fixed; top: 10px; left: 950px">
    <input type="submit" name="error" value="No Team" style="position: fixed; top: 10px; left: 1050px">
</form>
<img src="{{ asset(str_replace('.tif','.bmp',str_replace('\\','/',$data->path))) }}">
</body>
</html>