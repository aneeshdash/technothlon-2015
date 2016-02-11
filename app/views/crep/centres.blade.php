@extends('crep.master')
@section('head')
    <style>
        .progress span {
            width: 100%;
            font-size: 16px;
        }

        .progress {
            height: 30px;
        }

        .progress-bar {
            line-height: 30px;
        }
    </style>
    @endsection
@section('content')
    <section class="content-header">
        <h1 style="display: inline">
            Centres<br>
            <small>There are a lot of duplicate entries in online registration and around only half come for exam so increase the strength accordingly to accomodate those as hall tickets cannot be generated if the online centres are filled.</small>
        </h1>
        <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#newModal"><i class="fa fa-plus"></i> Add Centre</button>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-6">
                @if($errors->has())
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-ban"></i> There were some errors!</h4>
                        <ul>
                            {{ $errors->first('name', '<li>:message</li>') }}
                            {{ $errors->first('address', '<li>:message</li>') }}
                            {{ $errors->first('pincode', '<li>:message</li>') }}
                            {{ $errors->first('strength', '<li>:message</li>') }}
                            {{ $errors->first('online', '<li>:message</li>') }}
                        </ul>
                    </div>
                    @endif
                @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4>	<i class="icon fa fa-check"></i> Centre successfully added</h4>
                    </div>
                    @endif
            </div>
        </div>
        <div class="row">
            @foreach(Centre::where('city_id',Auth::crep()->get()->city_id)->get() as $centre)
                <?php
                    $id = Crypt::encrypt($centre->id);
                    while(strpos($id,'=') !== false) {
                        $id = Crypt::encrypt($centre->id);
                    }
                ?>
                <div class="col-sm-6" id="{{ $id }}">
                    <div class="small-box bg-yellow-gradient">
                        <div class="inner">
                            <h2 style="margin-top: 0px" id="name">{{ $centre->name }}</h2>
                            <div class="progress">
                                <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width:{{ (100*($centre->strength-$centre->left))/$centre->strength }}%">
                                    <span>{{ $centre->strength - $centre->left }} alloted</span>
                                </div>
                                <div class="pull-right" style="width: {{  (100*$centre->left)/$centre->strength }}%; text-align: center;color: #000000; vertical-align: middle; line-height: 30px">
                                    <span>{{ $centre->left }} left</span>
                                </div>
                            </div>
                        </div>
                        <div id="{{ $centre->code }}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                            <div class="box-body form-horizontal">
                                <div class="form-group" style="margin-bottom: 0px">
                                    <label class="col-sm-2 control-label">Strength</label>
                                    <div class="col-sm-4">
                                        <p class="form-control-static" id="strength">{{ $centre->strength }}</p>
                                    </div>
                                    <label class="col-sm-2 control-label">Filled</label>
                                    <div class="col-sm-4">
                                        <p class="form-control-static" id="filled">{{ $centre->strength - $centre->left }}</p>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-bottom: 0px">
                                    <label class="col-sm-2 control-label">Address</label>
                                    <div class="col-sm-4">
                                        <p class="form-control-static" id="address">{{ $centre->address }}</p>
                                    </div>
                                    <label class="col-sm-2 control-label">Online</label>
                                    <div class="col-sm-4">
                                        <p class="form-control-static" id="online">{{ $centre->online }}</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Pincode</label>
                                    <div class="col-sm-4">
                                        <p class="form-control-static" id="pincode">{{ $centre->pincode }}</p>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-bottom: 0px">
                                    <div class="col-sm-12">
                                        <button class="btn btn-primary pull-right edit" value="{{ $id }}"><i class="fa fa-edit"></i> Edit Details</button>
                                        <a class="btn btn-primary pull-left" href="{{ route('crepattendance',$id) }}" style="margin-right: 15px" onclick="alert('There are two sheets in the file, one offline and one online.')"><i class="fa fa-edit"></i> Download Attendance Sheet</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a data-toggle="collapse" href="#{{ $centre->code }}" aria-expanded="false" class="small-box-footer collapsed">
                            More info <i class="fa fa-arrow-circle-down"></i>
                        </a>
                    </div>
                </div>
                @endforeach
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit Centre Details</h4>
                </div>
                <form id="editform" role="form" class="form-horizontal">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="formname" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="formname" placeholder="Name" name="name" maxlength="250" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="formaddress" class="col-sm-2 control-label">Address</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="3" name="address" id="formaddress" maxlength="250" placeholder="Address" style="resize: none"></textarea>
                                <p class="help-block">Donot add city or state name.</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="formname" class="col-sm-2 control-label">Pincode</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="formpincode" placeholder="Pincode" name="pincode" min="100000" max="999999" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="formname" class="col-sm-2 control-label">Strength</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="formstrength" name="strength" placeholder="Strength of Centre" min="0" required>
                                <p class="help-block">Number of <b>teams</b> not students.<br>There are a lot of duplicate entries in online registration and around only half come for exam so increase the strength accordingly to accomodate those.</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="online" class="col-sm-2 control-label">Online</label>
                            <div class="col-sm-10">
                                <label class="radio-inline">
                                    <input type="radio" name="online" id="onlineYES" value="YES" required> YES
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="online" id="onlineNO" value="NO"> NO
                                </label>
                                <p class="help-block">Online teams will be assigned to this centre if "YES" is selected</p>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="formid" name="id" value="">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" name="edit" class="btn btn-primary" value="Save Changes">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Centre</h4>
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
                            <label for="formname" class="col-sm-2 control-label">Strength</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="strength" placeholder="Strength of Centre" min="0" required>
                                <p class="help-block">Number of <b>teams</b> not students.<br>There are a lot of duplicate entries in online registration and around only half come for exam so increase the strength accordingly to accomodate those.</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="online" class="col-sm-2 control-label">Online</label>
                            <div class="col-sm-10">
                                <label class="radio-inline">
                                    <input type="radio" name="online" id="inlineRadio1" value="YES" required> YES
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="online" id="inlineRadio2" value="NO"> NO
                                </label>
                                <p class="help-block">Online teams will be assigned to this centre if "YES" is selected</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" name="add" class="btn btn-primary" value="Add Centre">
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('.small-box-footer').click(function () {
                if($.trim($(this).html()) == 'More info <i class="fa fa-arrow-circle-down"></i>') {
                    $(this).html('Less info <i class="fa fa-arrow-circle-up"></i>');
                }
                else {
                    $(this).html('More info <i class="fa fa-arrow-circle-down"></i>');
                }
            });
        });

        $('.edit').click(function () {
            $('#formstrength').val($(this).closest('#'+$(this).val()).find('#strength').html());
            $('#formstrength').attr('min',$(this).closest('#'+$(this).val()).find('#filled').html());
            $('#formaddress').val($(this).closest('#'+$(this).val()).find('#address').html());
            $('#formpincode').val($(this).closest('#'+$(this).val()).find('#pincode').html());
            $('#formname').val($(this).closest('#'+$(this).val()).find('#name').html());
            $('#online'+$(this).closest('#'+$(this).val()).find('#online').html()).prop('checked',true);
            $('#formid').val($(this).val());
            $('#editModal').modal('show');
        });

        $('#editform').on('submit',function (e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('crepeditcentre') }}',
                method: 'post',
                data: $('#editform').serialize()
            })
                    .success(function (result) {
                        alert(result);
                        if($.trim(result) == 'Details Updated') {
                            location.reload();
                        }
                    })
                    .fail(function () {
                        alert('There was an error. Please Try Again');
                    });
        });

    </script>
    @endsection