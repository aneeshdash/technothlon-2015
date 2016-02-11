@extends('crep.master')
@section('content')
    <section class="content-header">
        <h1 style="display: inline">
            Centres
        </h1>
    </section>
    <section class="content">
        <div class="row">
            @foreach($schools as $school_id)
                <?php
                    $school=School::where('id',$school_id['school_id'])->first();
                    $id = Crypt::encrypt($school->id);
                    while(strpos($id,'=') !== false) {
                        $id = Crypt::encrypt($school->id);
                    }
                    $tobeallot = User::where('school_id',$school->id)->where('paid',1)->whereNull('centre_id')->count();
                    $total  = User::where('school_id',$school->id)->where('paid',1)->count();
                ?>

            <div class="col-sm-6 school" id="{{ $id }}">
                <div class="box @if($tobeallot == 0) box-success @else box-warning @endif box-solid" style="overflow: auto">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ $school->name }}</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body" style="display: block;">
                        <div class="col-sm-6"><b>To be allotted : <i class="tobe">{{ $tobeallot }}</i> teams</b></div>
                        <div class="col-sm-6">Total : {{ $total }} teams</div><br>
                        @if($tobeallot != 0)
                        <div class="form-inline allotform">
                            <select class="form-control centre">
                                {{ $centres }}
                            </select>
                            <input type="hidden" class="2ballot" value="{{ $tobeallot }}">
                            <button class="btn btn-default allot">Allot</button>
                        </div>
                        @endif
                        <br>
                        <a href="{{ route('crepadmitprint',$id) }}" target="_blank" class="btn btn-primary pull-right @if($tobeallot > 0) disabled @endif print" onclick="alert('Print the page that will be displayed.')"><i class="ion-printer" style="font-size: 20px"></i>&nbsp;&nbsp;  Print Admit Cards</a>
                        <div style="clear: both"></div>
                    </div><!-- /.box-body -->
                </div>
            </div>
                @endforeach
        </div>
    </section>
    @endsection
@section('script')
    <script>
        var needToConfirm1 = false;
        window.onbeforeunload = confirmExit;
        function confirmExit()
        {
            if (needToConfirm1)
                return 'Centre allocation is not yet complete. Do you want to exit?';
        }

        $('.allot').click(function() {
            div = $(this).closest('.school');
            limit = div.find('option:selected').data('limit');
            allot = div.find('.2ballot').val();
            if(allot > limit) {
                if(! confirm('The strength of centre is less than total regs from school.\nDo you want to continue?')) {
                    return;
                }
            }
            school = div.attr('id');
            centre = div.find('option:selected').val();
            needToConfirm1 = true;
            $.ajax({
                url: '{{ route('crepfuncallotcentre') }}',
                method: 'post',
                data: { school: school, centre: centre}
            })
                    .success(function (result) {
                        alert(result);
                        if($.trim(result) == 'Centre successfully allotted') {
                            if(allot >= limit) {
                                $('option[value="'+centre+'"]').remove();
                                div.find('.tobe').html(allot-limit);
                                div.find('.2ballot').val(allot-limit);
                            }
                            else {
                                box = div.find('.box');
                                box.removeClass('box-warning');
                                box.addClass('box-success');
                                div.find('.tobe').html('0');
                                div.find('.2ballot').val(0);
                                div.find('.allotform').remove();
                                div.find('.print').removeClass('disabled');
                            }
                        }
                    })
                    .fail(function () {
                        alert('There was an error. Please Try Again');
                    })
                    .done(function () {
                        needToConfirm1 = false;
                    });
        });

    </script>
    @endsection