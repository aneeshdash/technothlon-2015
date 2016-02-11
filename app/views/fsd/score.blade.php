@extends('layouts.master')
@section('title')
    FSD Junior | Score
@endsection
@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('CSS/leaderboard.css') }}">
@endsection
@section('body')
    <div class="container">
        <h1 style="text-align: center">APOCALYPSO: The Final Battle</h1>
        {{ $table  }}
    </div>
@endsection
@section('script')
    <script language="javascript" type="text/javascript">
        function scre() {
            var city = "{{ route('scoreupdate') }}";
            $.ajax({
                url: city,
                method: 'post',
                data: {},
                success: function(result) {
                    $('.rwd-table').html(result);
                }
            })
        }
        var score = function() {
            var timeout = window.setInterval(function () {
                scre();
            }, 500)
        };
        score();
    </script>
    @endsection