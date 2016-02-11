@extends('crep.master')
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
                    <form id="profile" method="post" role="form" class="form-horizontal">
                        <div class="box-body">
                            @if(Session::has('error'))
                            <div class="callout callout-danger">
                                <p>{{ Session::get('error') }}</p>
                            </div>
                            @endif
                            <div class="form-group">
                                <label for="name" class="control-label col-sm-2">Name:</label>
                                <div class="col-sm-10">
                                    <input type="text" id="name" class="form-control" placeholder="Name" name="name" value="{{ Auth::crep()->get()->name }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Email: </label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" placeholder="Email ID" name="email" value="{{ Auth::crep()->get()->email }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Contact: </label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" placeholder="Contact Number" name="contact" value="{{ Auth::crep()->get()->contact_home }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Webmail: </label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Webmail ID" name="webmail" value="{{ Auth::crep()->get()->webmail }}">
                                        <div class="input-group-addon">@iitg.ernet.in</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Gender: </label>
                                <div class="col-sm-10">
                                    <select name="gender" class="form-control">
                                        <option value="MALE" @if(Auth::crep()->get()->gender == 'MALE')selected @endif>Male</option>
                                        <option value="FEMALE" @if(Auth::crep()->get()->gender == 'FEMALE')selected @endif>Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">City: </label>
                                <div class="col-sm-10">
                                    <label class="control-label">{{ Auth::crep()->get()->city->name }}</label>
                                </div>
                            </div>
                            <div class="box-footer text-right">
                                <input type="submit" class="btn btn-primary" name="updatedetails" value="Update Details">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"> Change Password:</h3>
                    </div>
                    <form role="form" method="post" class="form-horizontal" id="chpass">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="oldpass" class="col-sm-3 control-label">Old Password:</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control pass" placeholder="Old Password" name="oldpass">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="newpass" class="col-sm-3 control-label">New Password:</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control pass" placeholder="New Password" name="newpass">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cnfnewpass" class="col-sm-3 control-label">Confirm New Password:</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control pass" placeholder="Confirm New Password" name="cnfnewpass">
                                </div>
                            </div>
                            <div class="box-footer text-right">
                                <input type="submit" name="chpass" class="btn btn-primary" value="Change Password">
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
        $('#chpass').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('crepchpass') }}',
                method: 'POST',
                data: $('#chpass').serialize()
            })
                    .success(function (result) {
                        $('.pass').val('');
                        alert(result);
                    })
                    .fail(function () {
                        alert('There was an error. Please Try Again.');
                    })
        });
    </script>
    @endsection