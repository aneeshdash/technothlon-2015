@extends('layouts.master')
@section('title')
    School Approval
@endsection
@section('head')
@endsection
@section('description')
    School Approve
@endsection
@section('body')
    <div class="container">
        <select id="state">
            <option value="all">All States</option>
            @foreach(State::orderBy('name')->get() as $state)
                <option value="{{ $state->id }}"> {{ $state->name }}</option>
            @endforeach
        </select><br>
        @foreach(School::where('verified', 0)->orderBy('city_id')->get() as $school)
            <div class="faq">
                <div class="question {{ $school->state_id }}"><strong>{{ $school->name }}</strong><br>
                    @foreach(City::where('id', $school->city_id)->get() as $city)
                        <p>{{ $city->name }}</p>
                        @endforeach
                </div>
                <div class="answer">
                    <table style="width: 100%">
                        <tr><td><label id="icon" for="name">School Name: </label></td>
                            <td style="width: 80%"><input type="text" class="name" name="name" id="name" placeholder="School Name" value="{{ $school->name }}" style="width: 75%"/></td></tr>
                        <tr><td><label id="icon" for="name">Address 1: </label></td>
                            <td><input type="text" class="addr1" name="addr1" id="name" placeholder="Address Line 1" value="{{ $school->address }}" style="width: 75%"/></td></tr>
                        <tr><td><label id="icon" for="name">School Contact: </label></td>
                            <td><input type="text" class="pincode" name="pincode" id="name" placeholder="Pin Code" value="{{ $school->contact }}" /></td></tr>
                        <tr><td><label id="icon" for="name">Pincode: </label></td>
                            <td><input type="text" class="contact" name="contact" id="name" placeholder="School Contact" value="{{ $school->pincode }}"/></td></tr>
                        <input class="id" value="{{ $school->id }}" style="display: none">
                    </table>
                    <select class="other" style="width: 90%">
                        <option>Other Schools</option>
                        @foreach(School::where('city_id', $school->city_id)->get() as $schools)
                            @if($school->id != $schools->id)
                            <option value="{{ $schools->id }}">{{ $schools->name }}, {{ $schools->address }}</option>
                            @endif
                        @endforeach
                    </select><br><br>
                    <input type="button" value="Go" class="go"/>
                    <input type="button" value="Replace" class="replace"/>
                </div>
            </div>
        @endforeach
        <script>
            $(document).ready(function () {
                $(".question").on("click", function (a) {
                    var $ele = $(this).parent().find(".answer");
                    if ($ele.is(':visible')) {
                        $(this).removeClass('active');
                        $ele.slideUp()
                    } else {
                        $(this).addClass('active');
                        $ele.slideDown();
                    }
                })
            });

            $('#state').change(function () {
                if($(this).val() == 'all') {
                    $('.question').show();
                }
                else {
                    $('.question').hide();
                    $('.'+$(this).val()).show();
                }
            });

            $('.go').click(function () {
                var schoolupdate="{{ route('schoolupdate') }}";
                var name=$(this).closest("div").find('.name').val();
                var addr=$(this).closest("div").find('.addr1').val();
                var pincode=$(this).closest("div").find('.pincode').val();
                var contact=$(this).closest("div").find('.contact').val();
                var id=$(this).closest("div").find('.id').val();
                $(this).closest("div").parent().hide();
                $.ajax({
                    url: schoolupdate,
                    method: 'post',
                    data: {name: name, addr: addr, pincode: pincode, contact: contact, id: id},
                    success: function() {
                        alert('School Details Updated')
                    }
                })
            });

            $('.replace').click(function () {
                alert('hi');
                var schoolreplace="{{ route('schoolreplace') }}"
                var originalid=$(this).closest("div").find('.id').val();
                var newid=$(this).closest("div").find('.other').val();
                $(this).closest("div").parent().hide();
                $.ajax({
                    url: schoolreplace,
                    method: 'post',
                    data: {originalid: originalid, newid: newid},
                    success: function() {
                        alert('School Details Replaced');
                    }
                })
            });
        </script>
@endsection
