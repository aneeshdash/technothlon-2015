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
            Downloads
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-6">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Download Question Papers</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody><tr>
                                <th style="width: 10px">#</th>
                                <th>Description</th>
                                <th>Download</th>
                            </tr>
                            <tr>
                                <td>1.</td>
                                <td>Junior - English</td>
                                <td><a href="{{ route('crepdown','QP_JUNIOR_ENGLISH') }}" target="_blank" class="btn btn-default">
                                        <i class="fa fa-download"></i> Download
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td>Junior - Hindi</td>
                                <td><a href="{{ route('crepdown','QP_JUNIOR_HINDI') }}" target="_blank" class="btn btn-default">
                                        <i class="fa fa-download"></i> Download
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>3.</td>
                                <td>Hauts - English</td>
                                <td><a href="{{ route('crepdown','QP_HAUTS_ENGLISH') }}" target="_blank" class="btn btn-default">
                                        <i class="fa fa-download"></i> Download
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>4.</td>
                                <td>Hauts - Hindi</td>
                                <td><a href="{{ route('crepdown','QP_HAUTS_HINDI') }}" target="_blank" class="btn btn-default">
                                        <i class="fa fa-download"></i> Download
                                    </a>
                                </td>
                            </tr>
                            </tbody></table>
                    </div><!-- /.box-body -->
                </div>
            </div>
            <div class="col-sm-6">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Download OMR Sheets</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody><tr>
                                <th style="width: 10px">#</th>
                                <th>Description</th>
                                <th>Download</th>
                            </tr>
                            <tr>
                                <td>1.</td>
                                <td>Junior - English</td>
                                <td><a href="{{ route('crepdown','OMR_JUNIOR_ENGLISH') }}" target="_blank" class="btn btn-default">
                                        <i class="fa fa-download"></i> Download
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td>Junior - Hindi</td>
                                <td><a href="{{ route('crepdown','OMR_JUNIOR_HINDI') }}" target="_blank" class="btn btn-default">
                                        <i class="fa fa-download"></i> Download
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>3.</td>
                                <td>Junior - TechnoFin</td>
                                <td><a href="{{ route('crepdown','OMR_JUNIOR_TECHNOFIN') }}" target="_blank" class="btn btn-default">
                                        <i class="fa fa-download"></i> Download
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>4.</td>
                                <td>Hauts - English</td>
                                <td><a href="{{ route('crepdown','OMR_HAUTS_ENGLISH') }}" target="_blank" class="btn btn-default">
                                        <i class="fa fa-download"></i> Download
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>5.</td>
                                <td>Hauts - Hindi</td>
                                <td><a href="{{ route('crepdown','OMR_HAUTS_HINDI') }}" target="_blank" class="btn btn-default">
                                        <i class="fa fa-download"></i> Download
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>6.</td>
                                <td>Hauts - TechnoFin</td>
                                <td><a href="{{ route('crepdown','OMR_HAUTS_TECHNOFIN') }}" target="_blank" class="btn btn-default">
                                        <i class="fa fa-download"></i> Download
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