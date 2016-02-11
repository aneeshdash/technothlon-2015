<html>
<head>
    <style>
        input[type="text"], input[type="number"] {
            width:30px;
            background-color: #00dd00;
            height: 16px;
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
    <input type="text" name="roll" autocomplete="off" size="10" style="position: absolute; top: 150px; left: 80px;width: 100px;height: 20px" value="{{ $data->roll }}">
    <input type="number" name="mobile" autocomplete="off" size="10" style="position: absolute; top: 150px; left: 380px;width: 100px; height: 20px" value="{{ $data->mobile }}">
    <input type="text" name="q1" size="1" style="position: absolute; top: 180px; left: 800px" value="{{ $data->q1 }}">
    <input type="text" name="q2" size="1" style="position: absolute; top: 195px; left: 800px" value="{{ $data->q2 }}">
    <input type="text" name="q3" size="1" style="position: absolute; top: 210px; left: 800px" value="{{ $data->q3 }}">
    <input type="text" name="q4" size="1" style="position: absolute; top: 225px; left: 800px" value="{{ $data->q4 }}">
    <input type="text" name="q5" size="1" style="position: absolute; top: 240px; left: 800px" value="{{ $data->q5 }}">
    <input type="text" name="q6" size="1" style="position: absolute; top: 255px; left: 800px" value="{{ $data->q6 }}">
    <input type="text" name="q7" size="1" style="position: absolute; top: 270px; left: 800px" value="{{ $data->q7 }}">
    <input type="text" name="q8" size="1" style="position: absolute; top: 285px; left: 800px" value="{{ $data->q8 }}">
    <input type="text" name="q9" size="1" style="position: absolute; top: 300px; left: 800px" value="{{ $data->q9 }}">
    <input type="text" name="q10" size="2" style="position: absolute; top: 315px; left: 800px" value="{{ $data->q10 }}">
    <input type="text" name="q11" size="2" style="position: absolute; top: 330px; left: 800px" value="{{ $data->q11 }}">
    <input type="text" name="q12" size="2" style="position: absolute; top: 345px; left: 800px" value="{{ $data->q12 }}">
    <input type="text" name="q13" size="2" style="position: absolute; top: 360px; left: 800px" value="{{ $data->q13 }}">
    <input type="text" name="q14" size="1" style="position: absolute; top: 480px; left: 30px" value="{{ $data->q14 }}">
    <input type="text" name="q15" size="1" style="position: absolute; top: 495px; left: 30px" value="{{ $data->q15 }}">
    <input type="text" name="q16" size="1" style="position: absolute; top: 510px; left: 30px" value="{{ $data->q16 }}">
    <input type="text" name="q17" size="1" style="position: absolute; top: 525px; left: 30px" value="{{ $data->q17 }}">
    <input type="text" name="q18" size="1" style="position: absolute; top: 540px; left: 30px" value="{{ $data->q18 }}">
    <input type="number" name="q19" size="1" style="position: absolute; top: 450px; left: 270px; height: 20px" value="{{ $data->q19 }}">
    <input type="number" name="q20" size="1" style="position: absolute; top: 450px; left: 330px; height: 20px" value="{{ $data->q20 }}">
    <input type="number" name="q21" size="1" style="position: absolute; top: 450px; left: 390px; height: 20px" value="{{ $data->q21 }}">
    <input type="number" name="q22" size="1" style="position: absolute; top: 450px; left: 450px; height: 20px" value="{{ $data->q22 }}">
    <input type="hidden" name="q23" value="">
    <input type="hidden" name="q24" value="">
    <input type="hidden" name="conf1" value="">
    <input type="hidden" name="conf2" value="">
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