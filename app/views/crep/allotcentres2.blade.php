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
                <div class="box @if($tobeallot == 0) box-success @else box-warning @endif box-solid">
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
                        <div class="form-inline">
                            <select class="form-control centre">
                                {{ $centres }}
                            </select>
                            <input type="hidden" class="2ballot" value="{{ $tobeallot }}">
                            <button class="btn btn-default allot">Allot</button>
                        </div>
                        @endif
                        <br>
                        <button class="btn btn-primary @if($school->admitgenerated == true || $tobeallot == $total)disabled @endif generate">  Generate Admit Cards</button>
                        <a href="{{ route('crepadmitdown',$id) }}" class="btn btn-primary pull-right @if($school->admitgenerated == false || $tobeallot == $total)disabled @endif download" onclick="alert('While printing admit cards please remove margins of page.')"><i class="fa fa-cloud-download"></i>  Download Admit Cards</a>
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
        var needToConfirm2 = false;
        window.onbeforeunload = confirmExit;
        function confirmExit()
        {
            if (needToConfirm1)
                return 'Centre allocation is not yet complete. Do you want to exit?';
            if (needToConfirm2)
                return 'Admit Card generation is not yet complete. Do you want to exit?';
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
            needToConfirm = true;
            $.ajax({
                url: '{{ route('crepfuncallotcentre') }}',
                method: 'post',
                data: { school: school, centre: centre}
            })
                    .success(function (result) {
                        alert(result);
                        if($.trim(result) == 'Centre successfully allotted') {
                            div.find('.generate').removeClass('disabled');
                            div.find('.download').addClass('disabled');
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

        $('.generate').click(function() {
            school = $(this).closest('.school').attr('id');
            button = $(this)
            button.addClass('disabled');
            button.html('Generating...');
            setTimeout("alert('Admit Card generation may take some time. Please be patient.');", 1);
            needToConfirm2 = true;
            $.ajax({
                url: '{{ route('crepfuncgenadmit') }}',
                method: 'post',
                data: { school: school},
                timeout: 0
            })
                    .success(function (result) {
                        alert(result);
                        if($.trim(result) == 'Admit Cards Generated') {
                            button.html('Generate Admit Cards');
                            button.closest('.school').find('.download').removeClass('disabled');
                        }
                    })
                    .fail(function () {
                        alert('There was an error. Please Try Again');
                        button.removeClass('disabled');
                        button.html('Generate Admit Cards');
                    })
                    .done(function () {
                        needToConfirm2 = false;
                    });
        });


    </script>
    @endsection