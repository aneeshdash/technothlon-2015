@extends('admin.master')
@section('head')
    @endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-sm-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"> Upload Result:</h3>
                    </div>
                    <form role="form" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
                        <div class="box-body">
                            @if(isset($error))
                                <div class="callout callout-danger">
                                    <p>{{ $error }}</p>
                                </div>
                            @endif
                            <div class="form-inline">
                                <div class="form-group">
                                    <label for="exampleInputFile">File input:</label>
                                    <input type="file" id="exampleInputFile" name="reg" required>
                                    <p class="help-block">Upload only csv files.</p>
                                </div>
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <input type="submit" class="btn btn-primary" value="Upload">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @endsection