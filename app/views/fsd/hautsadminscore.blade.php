<html>
<head>
    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
</head>
<body>
{{--<form method="post">--}}
    Winner: <input type="number" name="winner" id="winner"><br><br>
    Loser: <input type="number" name="loser" id="loser"><br><br>
    Time: <input type="checkbox" name="time" id="time"><br><br>
    Time: <input type="number" name="timeval" id="timeval"><br><br>
    Team: <input type="number" name="team" id="team"><br><br>
    <button id="updatescore">Update</button>
    {{--<input type="submit">--}}
{{--</form>--}}
<script>
    $('#updatescore').on('click',function() {
        var city = "{{ route('hautsupdatescore') }}";
        var winner = $('#winner').val();
        var loser = $('#loser').val();
        var timeval = $('#timeval').val();
        var time = $('#time').is(':checked');
        var team = $('#team').val();
        $.ajax({
            url: city,
            method: 'post',
            data: {winner: winner, loser: loser, timeval: timeval, time: time, team: team},
            success: function(result) {
            }
        })
    });
</script>
</body>
</html>