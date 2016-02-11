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
    <input type="text" name="roll" size="10" autocomplete="off" style="position: absolute; top: 150px; left: 80px;width: 100px" value="{{ $data->roll }}">
    <input type="number" name="mobile" size="10" autocomplete="off" style="position: absolute; top: 150px; left: 380px;width: 100px" value="{{ $data->mobile }}">
    <input type="text" name="q1" size="1" style="position: absolute; top: 160px; left: 770px" value="{{ $data->q1 }}">
    <input type="text" name="q2" size="1" style="position: absolute; top: 180px; left: 770px" value="{{ $data->q2 }}">
    <input type="text" name="q3" size="1" style="position: absolute; top: 200px; left: 770px" value="{{ $data->q3 }}">
    <input type="text" name="q4" size="1" style="position: absolute; top: 230px; left: 770px" value="{{ $data->q4 }}">
    <input type="text" name="q5" size="1" style="position: absolute; top: 250px; left: 770px" value="{{ $data->q5 }}">
    <input type="text" name="q6" size="1" style="position: absolute; top: 290px; left: 770px" value="{{ $data->q6 }}">
    <input type="text" name="q7" size="1" style="position: absolute; top:320px; left: 770px" value="{{ $data->q7 }}">
    <input type="text" name="q8" size="1" style="position: absolute; top: 350px; left: 770px" value="{{ $data->q8 }}">
    <input type="text" name="q9" size="1" style="position: absolute; top: 370px; left: 770px" value="{{ $data->q9 }}">
    <input type="text" name="conf1" size="1" style="position: absolute; top: 440px; left: 30px" value="{{ $data->conf1 }}">
    <input type="number" name="q10" size="2" style="position: absolute; top: 480px; left: 30px" value="{{ $data->q10 }}">
    <input type="number" name="q11" size="2" style="position: absolute; top: 430px; left: 160px" value="{{ $data->q11 }}">
    <input type="number" name="q12" size="2" style="position: absolute; top: 430px; left: 220px" value="{{ $data->q12 }}">
    <input type="number" name="q13" size="2" style="position: absolute; top: 430px; left: 280px" value="{{ $data->q13 }}">
    <input type="text" name="q14" size="1" style="position: absolute; top: 430px; left: 500px" value="{{ $data->q14 }}">
    <input type="text" name="q15" size="1" style="position: absolute; top: 450px; left: 500px" value="{{ $data->q15 }}">
    <input type="text" name="q16" size="1" style="position: absolute; top: 480px; left: 500px" value="{{ $data->q16 }}">
    <input type="text" name="q17" size="1" style="position: absolute; top: 500px; left: 500px" value="{{ $data->q17 }}">
    <input type="text" name="conf2" size="1" style="position: absolute; top: 530px; left: 500px" value="{{ $data->conf2 }}">
    <input type="text" name="q18" size="1" style="position: absolute; top: 550px; left: 500px" value="{{ $data->q18 }}">
    <input type="text" name="q19" size="1" style="position: absolute; top: 590px; left: 500px" value="{{ $data->q19 }}">
    <input type="text" name="q20" size="1" style="position: absolute; top: 610px; left: 500px" value="{{ $data->q20 }}">
    <input type="text" name="q21" size="1" style="position: absolute; top: 630px; left: 500px" value="{{ $data->q21 }}">
    <input type="text" name="q22" size="1" style="position: absolute; top: 650px; left: 500px" value="{{ $data->q22 }}">
    <input type="hidden" name="q23" value="">
    <input type="hidden" name="q24" value="">
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