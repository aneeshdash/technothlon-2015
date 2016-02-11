@extends('admin.master')
@section('content')
    <section class="content-header">
        <h1>
            Profile
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"> Update Details:</h3>
                    </div>
                    <form id="schdetails" method="post" role="form" class="form-horizontal">
                        <div class="box-body">
                            @if(Session::has('error'))
                                <div class="callout callout-danger">
                                    <p>{{ Session::get('error') }}</p>
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="state" class="control-label col-sm-2">State:</label>
                                <div class="col-sm-10">
                                    <select name="state" id="state" class="form-control" required>
                                        <option value="">Select State</option>
                                        @foreach(State::all() as $state)
                                            <option value="{{ $state->id }}">{{$state->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="city" class="control-label col-sm-2">City:</label>
                                <div class="col-sm-10">
                                    <select name="city" id="city" class="form-control" disabled required>
                                        <option value="">Select City</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">School: </label>
                                <div class="col-sm-10">
                                    <select name="school" id="school" class="form-control" disabled required>
                                        <option value="">Select School</option>
                                    </select>
                                </div>
                            </div>
                            <div class="box-footer text-right">
                                <input type="submit" class="btn btn-primary" value="Generate Passwords">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $('#state').change(function () {
            $('#school').val('');
            $('#school').prop("disabled", 1);
            $("#city").prop("disabled", !$('#state').val());
            var city = "{{ route('getcities') }}";
            $.ajax({
                url: city,
                method: 'post',
                data: {state: $(this).val()},
                success: function(result) {
                    $('#city').html(result);
                }
            })
        });

        $('#city').change(function () {
            $("#school").prop("disabled", !$('#city').val());
            var school = "{{ route('schoollist') }}";
            $.ajax({
                url: school,
                method: 'post',
                data: {city: $(this).val()},
                success: function (result) {
                    $('#school').html(result);
                }
            })
        });
    </script>
@endsection