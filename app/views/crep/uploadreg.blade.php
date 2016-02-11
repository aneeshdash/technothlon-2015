@extends('crep.master')
@section('head')
    @endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-sm-5">
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
                                <label for="school">School:</label>
                                <select class="form-control" name="school" id="school" required>
                                    <option value="">Select School</option>
                                    @foreach(School::where('city_id',Auth::crep()->get()->city_id)->orderBy('name')->get() as $schools)
                                        <option value="{{ $schools->id }}">{{ $schools->name }}</option>
                                        @endforeach
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
            <div class="col-sm-7">
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
                        <h4 style="display: inline">If school is not present, then </h4><button class="btn btn-primary" data-toggle="modal" data-target="#newModal"><i class="fa fa-plus"></i> Add School</button>
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
                            <p>Error fields highlighted in red. After corrections, upload the whole file again.</p>
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

    <!-- Modal -->
    <div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add School</h4>
                </div>
                <form id="newform" role="form" method="post" class="form-horizontal">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="formname" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Name" name="name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="formaddress" class="col-sm-2 control-label">Address</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="3" name="address" maxlength="250" placeholder="Address" style="resize: none"></textarea>
                                <p class="help-block">Donot add city or state name.</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="formname" class="col-sm-2 control-label">Pincode</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" placeholder="Pincode" name="pincode" min="100000" max="999999" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="formname" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" name="email" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="formname" class="col-sm-2 control-label">Contact</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="contact" placeholder="contact" maxlength="250" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" name="add" class="btn btn-primary" value="Add School">
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection

@section('script')
    <script>
        $('#newform').on('submit',function (e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('crepaddschool') }}',
                method: 'post',
                data: $('#newform').serialize()
            })
                    .success(function (result) {
                        $('#newModal').modal('hide');
                        if($.trim(result).indexOf('<option') > -1) {
                            $('#school').append(result);
                            alert('New School Added');
                        }
                        else {
                            alert(result);
                        }
                    })
                    .fail(function () {
                        alert('There was an error. Please Try Again');
                    });
        });
    </script>
    @endsection