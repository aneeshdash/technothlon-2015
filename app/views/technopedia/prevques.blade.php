@extends('layouts.master')
@section('title')
    Technopedia | {{ ucwords($month) }} Questions
@endsection
@section('body')
    <div class="container"><br><br>
        {{ $question->body }}<br><br>';
        <?php echo '<div style="text-align: center;"><b>';
        if($question->answer==Session::get('response'))
            echo 'You are correct';
        else if(Session::get('response'))
            echo 'You are wrong. The correct answer is '.$question->answer;
        echo '</b></div>';
        Session::forget('response'); ?>
        <br>
        @if(Session::get('index')%10 != 1)
            {{ '<form method="post"><input type="submit" style="float: left;" name ="response" value="Previous"></form>' }}
        @endif
        @if(Session::get('index')%10 !=0)
            {{ '<form method="post"><input type="submit" style="float: right;" name ="response" value="Next"></form>' }}
        @endif<br><br>
    </div>
@endsection