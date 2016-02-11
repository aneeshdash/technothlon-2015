@extends('crep.master')
@section('head')
    {{--<link href="{{ asset('DataTables-1.10.7/media/css/jquery.dataTables.css') }}" rel="stylesheet" type="text/css" />--}}
    <link href="{{ asset('DataTables-1.10.7/bootstrap/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
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
    </section>
    <section class="content">
        @foreach($schools as $school_id)
            <?php $school=School::where('id',$school_id['school_id'])->first(); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default collapsed-box">
                    <div class="box-header">
                        <h3 class="box-title">{{ $school->name }}</h3>
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
                                <th>Email 1</th>
                                <th>Email 2</th>
                                <th>Contact 1</th>
                                <th>Contact 2</th>
                                <th>Squad</th>
                                <th>Medium</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach(User::where('school_id',$school->id)->where('roll','LIKE','%'.$code.'0%')->get() as $user)
                            <tr>
                                <td>{{ $user->name1 }}</td>
                                <td>{{ $user->name2 }}</td>
                                <td>{{ $user->roll }}</td>
                                <td>{{ $user->email1 }}</td>
                                <td>{{ $user->email2 }}</td>
                                <td>{{ $user->contact1 }}</td>
                                <td>{{ $user->contact2 }}</td>
                                <td>{{ $user->squad }}</td>
                                <td>{{ $user->language }}</td>
                            </tr>
                                @endforeach
                            <tfoot>
                            <tr>
                                <th>Name 1</th>
                                <th>Name 2</th>
                                <th>Roll Number</th>
                                <th>Email 1</th>
                                <th>Email 2</th>
                                <th>Contact 1</th>
                                <th>Contact 2</th>
                                <th>Squad</th>
                                <th>Medium</th>
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
                                    <th>School</th>
                                    <th>Email 1</th>
                                    <th>Email 2</th>
                                    <th>Contact 1</th>
                                    <th>Contact 2</th>
                                    <th>Squad</th>
                                    <th>Medium</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach(User::where('roll','LIKE','%'.$code.'1%')->get() as $user)
                                    <tr>
                                        <td>{{ $user->name1 }}</td>
                                        <td>{{ $user->name2 }}</td>
                                        <td>{{ $user->roll }}</td>
                                        <td>{{ $user->school->name }}</td>
                                        <td>{{ $user->email1 }}</td>
                                        <td>{{ $user->email2 }}</td>
                                        <td>{{ $user->contact1 }}</td>
                                        <td>{{ $user->contact2 }}</td>
                                        <td>{{ $user->squad }}</td>
                                        <td>{{ $user->language }}</td>
                                    </tr>
                                @endforeach
                                <tfoot>
                                <tr>
                                    <th>Name 1</th>
                                    <th>Name 2</th>
                                    <th>Roll Number</th>
                                    <th>School</th>
                                    <th>Email 1</th>
                                    <th>Email 2</th>
                                    <th>Contact 1</th>
                                    <th>Contact 2</th>
                                    <th>Squad</th>
                                    <th>Medium</th>
                                </tr>
                                </tfoot>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection

@section('script')
    <!-- DATA TABES SCRIPT -->
    <script src="{{ asset('DataTables-1.10.7/media/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('DataTables-1.10.7/bootstrap/dataTables.bootstrap.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
            $('.school').DataTable();

            $(window).resize( function () {
                table.columns.adjust();
            } );
        });
    </script>
@endsection