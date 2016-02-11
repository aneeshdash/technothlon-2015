@extends('admin.master')
@section('head')
    @endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-sm-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"> Update Details:</h3>
                    </div>
                    <form role="form" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
                        <div class="box-body">
                            @if(isset($error))
                                <div class="callout callout-danger">
                                    <p>{{ $error }}</p>
                                </div>
                            @endif
                            <div class="form-group">
                                <div class="form-inline">
                                    <div class="form-group">
                                        <label for="state">State:</label>
                                        <select class="form-control" name="state" id="state" required>
                                            <option value="">Select State</option>
                                            @foreach(State::orderBy('name')->get() as $state)
                                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="city">City:</label>
                                        <select class="form-control" name="city" id="city" required disabled>
                                            <option value="">Select City</option>
                                        </select>
                                    </div>
                                    <div class="form-group" style="margin-left: 20px">
                                        <label for="city">KV:</label>
                                        <label class="radio-inline">
                                            <input type="radio" name="kv" value="yes" required> Yes
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="kv" value="no" checked> No
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="school">School:</label>
                                <select class="form-control" name="school" id="school" required disabled>
                                    <option value="">Select School</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">File input:</label>
                                <input type="file" id="exampleInputFile" name="reg" required>
                                <p class="help-block">Upload only csv files.</p>
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Upload">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Upload Instructions:</h3>
                    </div>
                    <div class="box-body">
                        <h5><a href="{{ asset('regs/reg-sample.csv') }}" class="btn btn-primary">Download</a> the template file and add the details to that file and upload it.(<b>DONOT edit the first row of the file</b>)</h5>
                        <ol>
                            <li>In a single file upload atmost 100 teams.</li>
                            <li>Contact numbers can have only digits.</li>
                            <li>Language can take values either "<b>en</b>" (for english) or "<b>hi</b>" (for hindi).</li>
                            <li>Squad can take values either "<b>JUNIOR</b>" or "<b>HAUTS</b>".</li>
                            <li>Upload only csv files.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                @if(isset($reg_errors))
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Errors:</h3>
                            <p>Error fields highlighted in red.</p>
                        </div>
                        <div class="box-body table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Name 1</th>
                                    <th>Name 2</th>
                                    <th>Email 1</th>
                                    <th>Email 2</th>
                                    <th>Contact 1</th>
                                    <th>Contact 2</th>
                                    <th>Language</th>
                                    <th>Squad</th>
                                </tr>
                                {{ $reg_errors }}
                            </table>
                        </div>
                    </div>
                    @endif
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
                    success: function(result) {
                        $('#school').html(result);
                    }
                })
        });
    </script>
    @endsection