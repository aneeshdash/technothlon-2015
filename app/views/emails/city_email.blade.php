@extends('layouts.master')
@section('title')
    Mail CIty Wise
    @endsection
@section('body')
    <div class="container">
            @foreach(City::orderBy('state_id')->get() as $city)
            <div style="width: 100%; margin: 10px 0">
                <div class="city" id="{{ $city->id }}" style="display: inline">{{ $city->name }}, {{ $city->State->name }}</div>
                <div style="display: inline-block"><button value="Send" class="send">Send</button> </div>
            </div>
                @endforeach
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