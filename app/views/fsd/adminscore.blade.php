<html>
<head>
    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
</head>
<body>
{{--<form method="post">--}}
    Team1: <input type="number" name="team1" id="team1"><br><br>
    Team2: <input type="number" name="team2" id="team2"><br><br>
    Team3: <input type="number" name="team3" id="team3"><br><br>
    Team4: <input type="number" name="team4" id="team4"><br><br>
    Team5: <input type="number" name="team5" id="team5"><br><br>
    <button id="updatescore">Update</button>
    {{--<input type="submit">--}}
{{--</form>--}}
<script>
    $('#updatescore').on('click',function() {
        var city = "{{ route('updatescore') }}";
        var team1 = $('#team1').val();
        var team2 = $('#team2').val();
        var team3 = $('#team3').val();
        var team4 = $('#team4').val();
        var team5 = $('#team5').val();
        $.ajax({
            url: city,
            method: 'post',
            data: {team1: team1, team2: team2, team3: team3, team4: team4, team5: team5},
            success: function(result) {
            }
        })
    });
</script>
</body>
</html>