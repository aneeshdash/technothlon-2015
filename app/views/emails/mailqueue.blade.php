@extends('layouts.master')
@section('title')
    Mail CIty Wise
@endsection
@section('body')
    <div class="container">
        Start:1000
    </div>

    <script>
        $('.send').click(function () {
            alert($(this).parent('div').parent('div').find('.city').attr('id'));
            var citymail = "{{ route('citymail') }}";
            var cityid=$(this).parent('div').parent('div').find('.city').attr('id');
            $.ajax({
                url: citymail,
                method: 'post',
                data: {city: cityid },
                success: function() {
                    alert('Mail Sent')
                }
            })
        });
    </script>
@endsection