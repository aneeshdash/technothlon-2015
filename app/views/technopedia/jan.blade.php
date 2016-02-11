@extends('layouts.master')
@section('title')
Technopedia | January Questions
@endsection
@section('body')
<div class="container"><br><br>
<?php
$question = DB::table('technopedia_ques')->where('id',Session::get('index'))->get();
echo $question[0]->body.'<br><br>';
echo '<div style="text-align: center;"><strong>';
if($question[0]->answer==Session::get('response'))
echo 'You are correct';
else if(Session::get('response'))
echo 'You are wrong. The correct answer is '.$question[0]->answer;
echo '</strong></div>';
Session::forget('response');
?><br>
@if(Session::get('index')!=1)
{{ '<form method="post"><input type="submit" style="float: left;" name ="response" value="Previous"></form>' }}
@endif
@if(Session::get('index')!=10)
{{ '<form method="post"><input type="submit" style="float: right;" name ="response" value="Next"></form>' }}
@endif<br><br>
</div>
    @endsection
