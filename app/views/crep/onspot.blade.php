@extends('crep.master')
@section('head')
    <style>
        .form-group, .control-label {
            margin-right: 20px;
        }

        .badge {
            font-size: 20px;
        }
        td {
            font-size: 16px;
        }
    </style>
    @endsection
@section('content')
    <section class="content-header">
        <h1>
            On-spot Registration Forms (optional)
            <small>Generate the number of on-spot forms as per your conveniency.</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Generate Registration Forms</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <form role="form" class="form-inline">
                            <div class="form-group">
                                <label for="squad" class=" control-label">Squad</label>
                                <label class="radio-inline">
                                    <input type="radio" name="squad" id="inlineRadio1" value="JUNIOR" required> JUNIOR
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="squad" id="inlineRadio2" value="HAUTS"> HAUTS
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="online" class="control-label">Medium</label>
                                <label class="radio-inline">
                                    <input type="radio" name="medium" id="inlineRadio1" value="en" required> English
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="medium" id="inlineRadio2" value="hi"> Hindi
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="formname" class="control-label">Quantity</label>
                                <input type="number" class="form-control" name="qty" placeholder="No. of forms" min="0" required>
                            </div>
                            <input type="submit" class="btn btn-default" value="Generate">
                        </form>
                    </div>
                </div>
            </div>
        </div><br>
        <div class="row">
            <div class="col-sm-6">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Download Registration Forms</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody><tr>
                                <th style="width: 10px">#</th>
                                <th>Squad - Medium</th>
                                <th style="width: 25px">Quantity</th>
                                <th>Download</th>
                            </tr>
                            <tr>
                                <td>1.</td>
                                <td>Junior - English</td>
                                <td><span class="badge bg-red JUNIORen">{{ User::where('city_id',Auth::crep()->get()->city_id)->where('roll','LIKE','JE%')->where('status',3)->count() }}</span></td>
                                <td><a href="{{ route('creponspotdown','JUNIOR/en') }}" target="_blank" class="btn btn-default">
                                        <i class="fa fa-save"></i> Download
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td>Junior - Hindi</td>
                                <td><span class="badge bg-red JUNIORhi">{{ User::where('city_id',Auth::crep()->get()->city_id)->where('roll','LIKE','JH%')->where('status',3)->count() }}</span></td>
                                <td><a href="{{ route('creponspotdown','JUNIOR/hi') }}" target="_blank" class="btn btn-default">
                                        <i class="fa fa-save"></i> Download
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>3.</td>
                                <td>Hauts - English</td>
                                <td><span class="badge bg-red HAUTSen">{{ User::where('city_id',Auth::crep()->get()->city_id)->where('roll','LIKE','HE%')->where('status',3)->count() }}</span></td>
                                <td><a href="{{ route('creponspotdown','HAUTS/en') }}" target="_blank" class="btn btn-default">
                                        <i class="fa fa-save"></i> Download
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>4.</td>
                                <td>Hauts - Hindi</td>
                                <td><span class="badge bg-red HAUTShi">{{ User::where('city_id',Auth::crep()->get()->city_id)->where('roll','LIKE','HH%')->where('status',3)->count() }}</span></td>
                                <td><a href="{{ route('creponspotdown','HAUTS/hi') }}" target="_blank" class="btn btn-default">
                                        <i class="fa fa-save"></i> Download
                                    </a>
                                </td>
                            </tr>
                            </tbody></table>
                    </div><!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
    @endsection

@section('script')
    <script>
        $('a').click(function () {
            alert('While creating PDF, set page margin to 0 and layout as Portrait');
        });
    </script>
    <script>
        var needToConfirm = false;
        window.onbeforeunload = confirmExit;
        function confirmExit()
        {
            if (needToConfirm)
                return 'Form generation is not yet complete. Do you want to exit?';
        }

        $('.form-inline').on('submit', function (e) {
            e.preventDefault();
            setTimeout("alert('Form generation may take some time. Please be patient.');", 1);
            needToConfirm = true;
            $.ajax({
                url: '{{ route('creponspotgen') }}',
                method: 'post',
                data: $('.form-inline').serialize()
            })
                    .success(function (result) {
                        alert(result);
                        if($.trim(result) == 'Forms Generated') {
                            var squad = $("input[name=squad]:checked").val();
                            var medium = $("input[name=medium]:checked").val();
                            $('.'+squad+medium).html(parseInt($('.'+squad+medium).html())+parseInt($("input[name=qty]").val()));
                        }
                    })
                    .fail(function () {
                        alert('There was an error. Please Try Again');
                    })
                    .done(function () {
                        needToConfirm = false;
                    });
        });
    </script>
    @endsection