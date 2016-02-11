@extends('admin.master')
@section('head')
    {{--<link href="{{ asset('DataTables-1.10.7/media/css/jquery.dataTables.css') }}" rel="stylesheet" type="text/css" />--}}
    <link href="{{ asset('DataTables-1.10.7/bootstrap/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('DataTables-1.10.7/extensions/TableTools/css/dataTables.tableTools.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        @-moz-document url-prefix() {
            fieldset {
                display: table-cell;
            }
        }
    </style>
@endsection
@section('content')
    <section class="content-header">
        <h1>
            Registrations
            <small>it starts here</small>
        </h1>
        <br>
        <form class="form-inline" method="post">
            <div class="form-group">
                <select id="state" class="form-control" required>
                    <option value="">State</option>
                    @foreach(State::orderBy('name')->get() as $state)
                        <option value="{{ $state->id }}">{{$state->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <select id="city" name="city" class="form-control" required disabled>
                    <option value="">City</option>
                </select>
            </div><br>
            <input type="submit" class="btn btn-primary" style="margin-top: 10px" value="Show">
        </form>
    </section>
    <section class="content">
        @if(isset($schools))
            <div class="row">
                <div class="col-sm-3">
                    <h4>Offline: {{ User::where('city_id',$city)->where('paid',1)->count() }}</h4>
                </div>
                <div class="col-sm-3">
                    <h4>Online: {{ User::where('centre_city',$city.'0')->where('paid',0)->count() }}</h4>
                </div>
                <div class="col-sm-3">
                    <h4>Collected in Summer: {{ User::where('city_id',$city)->where('paid',1)->where('status',1)->count() }}</h4>
                </div>
            </div>
            @foreach($schools as $school_id)
                <?php $school=School::where('id',$school_id['school_id'])->first(); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-default collapsed-box">
                            <div class="box-header">
                                <h3 class="box-title">{{ $school->name }}  (Regs: {{ User::where('school_id',$school->id)->where('paid',1)->count() }})</h3>
                                <div class="box-tools pull-right">
                                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            <div class="box-body table-responsive" style="display: none">
                                <table id="{{ $school->id }}" class="table table-bordered table-striped table-hover dataTable school">
                                    <thead>
                                    <tr>
                                        <th>Name 1</th>
                                        <th>Name 2</th>
                                        <th>Roll Number</th>
                                        <th>Password</th>
                                        <th>Rank</th>
                                        <th>Percentile</th>
                                        <th>Email 1</th>
                                        <th>Email 2</th>
                                        <th>Contact 1</th>
                                        <th>Contact 2</th>
                                        <th>Squad</th>
                                        <th>Medium</th>
                                        <th>Edit/Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach(User::where('school_id',$school->id)->where('paid',1)->get() as $user)
                                        <?php
                                        try {
                                            $pass = Crypt::decrypt($user->result_pass);
                                        }
                                        catch(Exception $e) {
                                            $pass = 'NA';
                                        }
                                                $res = DB::table('results_2015')->where('roll',$user->roll)->first();
                                        ?>
                                        <tr>
                                            <td>{{ $user->name1 }}</td>
                                            <td>{{ $user->name2 }}</td>
                                            <td>{{ $user->roll }}</td>
                                            <td>{{ $pass }}</td>
                                            @if($res)
                                                @if($res->rank < 1000)
                                                    <td>{{ $res->rank }}</td>
                                                    <td>NA</td>
                                                @else
                                                    @if($user->roll[0] == 'J')
                                                        <td>NA</td>
                                                        <td>{{ number_format((18000 - $res->rank)/180,2) }}</td>
                                                    @else
                                                        <td>NA</td>
                                                        <td>{{ number_format((9000 - $res->rank)/90,2) }}</td>
                                                    @endif
                                                @endif
                                            @else
                                                <td>NA</td>
                                                <td>NA</td>
                                            @endif
                                            <td>{{ $user->email1 }}</td>
                                            <td>{{ $user->email2 }}</td>
                                            <td>{{ $user->contact1 }}</td>
                                            <td>{{ $user->contact2 }}</td>
                                            <td>{{ $user->squad }}</td>
                                            <td>{{ $user->language }}</td>
                                            <td id="{{ $user->id }}">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-sm btn-info edit">Edit</button>
                                                    <button type="button" class="btn btn-sm btn-danger delete">Delete</button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tfoot>
                                    <tr>
                                        <th>Name 1</th>
                                        <th>Name 2</th>
                                        <th>Roll Number</th>
                                        <th>Password</th>
                                        <th>Rank</th>
                                        <th>Percentile</th>
                                        <th>Email 1</th>
                                        <th>Email 2</th>
                                        <th>Contact 1</th>
                                        <th>Contact 2</th>
                                        <th>Squad</th>
                                        <th>Medium</th>
                                        <th>Edit/Delete</th>
                                    </tr>
                                    </tfoot>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default collapsed-box">
                        <div class="box-header">
                            <h3 class="box-title">Online</h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="box-body table-responsive" style="display: none">
                            <table id="0" class="table table-bordered table-striped table-hover dataTable school">
                                <thead>
                                <tr>
                                    <th>Name 1</th>
                                    <th>Name 2</th>
                                    <th>Roll Number</th>
                                    <th>Password</th>
                                    <th>Rank</th>
                                    <th>Percentile</th>
                                    <th>Email 1</th>
                                    <th>Email 2</th>
                                    <th>Contact 1</th>
                                    <th>Contact 2</th>
                                    <th>Squad</th>
                                    <th>Medium</th>
                                    <th>Edit/Delete</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach(User::where('centre_city',$city.'0')->where('paid',0)->get() as $user)
                                    <?php
                                    try {
                                        $pass = Crypt::decrypt($user->result_pass);
                                    }
                                    catch(Exception $e) {
                                        $pass = 'NA';
                                    }
                                    $res = DB::table('results_2015')->where('roll',$user->roll)->first();
                                    ?>
                                    <tr>
                                        <td>{{ $user->name1 }}</td>
                                        <td>{{ $user->name2 }}</td>
                                        <td>{{ $user->roll }}</td>
                                        <td>{{ $pass }}</td>
                                        @if($res)
                                            @if($res->rank < 1000)
                                                <td>{{ $res->rank }}</td>
                                                <td>NA</td>
                                            @else
                                                @if($user->roll[0] == 'J')
                                                    <td>NA</td>
                                                    <td>{{ number_format((18000 - $res->rank)/180,2) }}</td>
                                                @else
                                                    <td>NA</td>
                                                    <td>{{ number_format((9000 - $res->rank)/90,2) }}</td>
                                                @endif
                                            @endif
                                        @else
                                            <td>NA</td>
                                            <td>NA</td>
                                        @endif
                                        <td>{{ $user->email1 }}</td>
                                        <td>{{ $user->email2 }}</td>
                                        <td>{{ $user->contact1 }}</td>
                                        <td>{{ $user->contact2 }}</td>
                                        <td>{{ $user->squad }}</td>
                                        <td>{{ $user->language }}</td>
                                        <td id="{{ $user->id }}">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-info edit" data-name1="{{ $user->name1 }}" data-name2="{{ $user->name2 }}" data-email1="{{ $user->email1 }}" data-email2="{{ $user->email2 }}" data-contact1="{{ $user->contact1 }}" data-contact2="{{ $user->contact2 }}">Edit</button>
                                                <button type="button" class="btn btn-sm btn-danger delete">Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                <tfoot>
                                <tr>
                                    <th>Name 1</th>
                                    <th>Name 2</th>
                                    <th>Roll Number</th>
                                    <th>Password</th>
                                    <th>Rank</th>
                                    <th>Percentile</th>
                                    <th>Email 1</th>
                                    <th>Email 2</th>
                                    <th>Contact 1</th>
                                    <th>Contact 2</th>
                                    <th>Squad</th>
                                    <th>Medium</th>
                                    <th>Edit/Delete</th>
                                </tr>
                                </tfoot>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif
    </section>

    <div class="modal fade" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Data</h4>
                </div>
                <form id="edit" class="form-horizontal" method="post" role="form">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name1" class="control-label col-sm-2">Name1:</label>
                            <div class="col-sm-10">
                                <input type="text" id="name1" class="form-control" placeholder="Name" name="name1" value="{{ Auth::admin()->get()->name }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name2" class="control-label col-sm-2">Name:</label>
                            <div class="col-sm-10">
                                <input type="text" id="name2" class="form-control" placeholder="Name" name="name2" value="{{ Auth::admin()->get()->name }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Email1: </label>
                            <div class="col-sm-10">
                                <input type="email" id="email1" class="form-control" placeholder="Email ID" name="email1" value="{{ Auth::admin()->get()->email }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Email2: </label>
                            <div class="col-sm-10">
                                <input type="email" id="email2" class="form-control" placeholder="Email ID" name="email2" value="{{ Auth::admin()->get()->email }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Contact1: </label>
                            <div class="col-sm-10">
                                <input type="number" id="contact1" class="form-control" placeholder="Contact Number" name="contact1" value="{{ Auth::admin()->get()->contact }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Contact2: </label>
                            <div class="col-sm-10">
                                <input type="number" id="contact2" class="form-control" placeholder="Contact Number" name="contact2" value="{{ Auth::admin()->get()->contact }}" required>
                            </div>
                        </div>
                        <input type="hidden" id="id" name="id" value="">
                        <input type="hidden" id="row" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Save Changes">
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('script')
    <!-- DATA TABES SCRIPT -->
    <script src="{{ asset('DataTables-1.10.7/media/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('DataTables-1.10.7/bootstrap/dataTables.bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('DataTables-1.10.7/extensions/TableTools/js/dataTables.tableTools.min.js') }}"></script>
    <script type="text/javascript">
            var tables = $('.school').DataTable();
            $(window).resize( function () {
                tables.columns.adjust();
            } );
        $('.edit').click(function () {
//            alert($(this).closest('td').attr('id'));
            $('#name1').val($(this).data('name1'));
            $('#name2').val($(this).data('name2'));
            $('#email1').val($(this).data('email1'));
            $('#email2').val($(this).data('email2'));
            $('#contact1').val($(this).data('contact1'));
            $('#contact2').val($(this).data('contact2'));
            $('#id').val($(this).closest('td').attr('id'));
            $('#row').val(tables.row($(this).parents('tr')).index());
            $('#editModal').modal('show');
//            console.log( tables.row( $(this).parents('tr')).data() );
        });

        $('#edit').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('admineditregs') }}',
                method: 'post',
                data: $('#edit').serialize()
            })
                    .success(function (result) {
                        var d= new Array();
                        d[0]=$('#name1').val();
                        d[1]=$('#name2').val();
                        d[2]=$('#email1').val();
                        d[3]=$('#email2').val();
                        d[4]=$('#contact1').val();
                        d[5]=$('#contact2').val();
                        tables.cell($('#row').val(),0).data(d[0]);
                        tables.cell($('#row').val(),1).data(d[1]);
                        tables.cell($('#row').val(),4).data(d[2]);
                        tables.cell($('#row').val(),5).data(d[3]);
                        tables.cell($('#row').val(),6).data(d[4]);
                        tables.cell($('#row').val(),7).data(d[5]).draw();
                        alert('Entry Edited');
                    })
                    .fail(function () {
                        alert('There was an error. Please Try Again');
                    });
            $('#editModal').modal('hide');
        })

        $('.delete').click(function () {
            var id = $(this).closest('td').attr('id');
            $.ajax({
                url: '{{ route('admindeleteregs') }}',
                method: 'post',
                data: {id: id}
            })
                    .success(function (result) {
                        alert('Entry Deleted');
                        tables.row($(this).parents('tr')).remove().draw();
                    })
                    .fail(function () {
                        alert('There was an error. Please Try Again');
                    });
            });
    </script>
    <script>
        $('#state').change(function () {
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
    </script>
    <script>

    </script>
@endsection