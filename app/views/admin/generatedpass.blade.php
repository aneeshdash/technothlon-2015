@extends('admin.master')
@section('content')
    <section class="content-header">
        <h1>
            Generated Passwords
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">{{ $school->name }}, {{ $school->city->name }}</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Name 1</th>
                                <th>Name 2</th>
                                <th>Roll Number</th>
                                <th>Password</th>
                            </tr>
                            {{ $body }}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection