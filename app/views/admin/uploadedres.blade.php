@extends('admin.master')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Registraiton Details:</h3>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>Roll Number</th>
                                <th>Rank</th>
                            </tr>
                            {{ $details }}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection