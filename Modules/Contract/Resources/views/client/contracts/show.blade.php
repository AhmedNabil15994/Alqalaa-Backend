@extends('apps::client.layouts.app')
@section('title', __('contract::client.contracts.routes.index'))
@section('content')

    <div class="page-content-wrapper">

        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{ url(route('client.home')) }}">{{ __('apps::client.index.title') }}</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="{{ url(route('client.contracts.index')) }}">
                            {{__('contract::client.contracts.routes.index')}}
                        </a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="#">{{__('contract::client.contracts.routes.show')}}</a>
                    </li>
                </ul>
            </div>

            <h1 class="page-title"></h1>

            <div class="row">
                <div class="col-md-12">

                @include('apps::client.layouts._ajax-msg')
                <!-- Begin: life time stats -->
                    <div class="portlet light portlet-fit portlet-datatable bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-settings font-dark"></i>
                                <span class="caption-subject font-dark sbold uppercase"> {{__('contract::client.contracts.show.titles.contract')}} #{{$model->contract_number}}
                                                <span class="hidden-xs">| {{$model->created_at->locale(locale())->isoFormat('dddd  , MMMM  ,  Do / YYYY ')}} </span>
                                            </span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="tabbable-line">
                                <ul class="nav nav-tabs nav-tabs-lg">
                                    <li class="active">
                                        <a href="#tab_2"
                                           data-toggle="tab"> {{__('contract::client.contracts.show.titles.installments')}} </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_2">
                                        <div class="table-container" style="">
                                            @if($model->installments->count())
                                                <div class="portlet light bordered">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <i class="icon-social-dribbble font-blue"></i>
                                                            <span class="caption-subject font-blue bold uppercase">{{__('contract::client.contracts.show.titles.instalments')}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body" id="instalment-table">
                                                        @include('contract::client.contracts.components.instalment-table')
                                                    </div>
                                                </div>

                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End: life time stats -->
                </div>
            </div>
        </div>
    </div>

    @if(auth('client')->user()->is_judging == 0)
        <div class="modal fade bd-example-modal-lg"
             id="pay-installment"
             tabindex="-1"
             role="dialog"
             aria-labelledby="myLargeModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content animated bounceInRight">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            {{__('contract::client.contracts.show.btn.pay_installment')}}
                        </h4>
                    </div>
                    <div class="modal-body">
                        {!! Form::open([
                            'url' => url(route('client.installments.create','::id')),
                            'id'=>'instalment-form',
                            'method' => 'put',
                        ]) !!}

                        <input type="hidden" name="contract_id"  value="{{$model->id}}">
                        {!! field()->number('' ,__('contract::client.contracts.show.info.instalments_details.contract_id'), $model->contract_number , ['readonly' => 'readonly']) !!}
                        {!! field()->number('amount' ,__('contract::client.contracts.show.info.instalments_details.total_amount') , '::amount' , ['readonly' => 'readonly']) !!}
                        {!! field()->number('paid' ,__('contract::client.contracts.show.info.instalments_details.paid_amount') , '::paid' , ['readonly' => 'readonly']) !!}
                        {!! field()->number('remaining' ,__('contract::client.contracts.show.info.instalments_details.remaining_amount') , '::remaining' , ['readonly' => 'readonly']) !!}
                        {!! field()->number('pay_now' ,__('contract::client.contracts.show.info.instalments_details.paid_amount') , '::remaining' , ['step'=> '0.001']) !!}
                    </div>
                    <div class="modal-footer">
                        <div class="clearfix"></div>
                        <br>
                        <button type="button"
                                class="btn btn-white"
                                data-dismiss="modal">
                            {{__('contract::client.contracts.show.btn.cancel')}}
                        </button>
                        {!! Form::submit('حفظ',[
                            'class' => 'btn btn-primary'
                            ]) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    @endif

@stop

@push('scripts')
    <script>
        function openPayModel(data) {
            resetErrors();

            @if(auth('client')->user()->is_judging == 0)
                var $form = $('#instalment-form');
                var url = '{{ route('client.installments.create',':id') }}';
                url = url.replace(':id', data.id);
                $form.attr('action', url);
                $('#amount').val(data.amount);
                $('#paid').val(data.paid);
                $('#remaining').val(data.remaining);
                $('#pay_now').val(data.remaining);
                $("#pay-installment").modal('show');
            @endif
        }

        function refreshInstalmentTable() {
            $.ajax({
                url: '{{url(route('client.contracts.refresh.table',$model->id))}}',
                type: 'get',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    $('#instalment-table').text('').append(data.table);
                    $(".modal").modal('hide');
                },
            });
        }

        $('#instalment-form').on('submit', function (e) {
            e.preventDefault();

            tinyMCE.triggerSave();

            var url = $(this).attr('action');
            var method = $(this).attr('method');

            $.ajax({

                xhr: function () {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function (evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            percentComplete = parseInt(percentComplete * 100);
                            $('.progress-bar').width(percentComplete + '%');
                            $('#progress-status').html(percentComplete + '%');
                        }
                    }, false);
                    return xhr;
                },

                url: url,
                type: method,
                dataType: 'JSON',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,

                beforeSend: function () {
                    $('#submit').prop('disabled', true);
                    $('.progress-info').show();
                    $('.progress-bar').width('0%');
                    resetErrors();
                },
                success: function (data) {

                    $('#submit').prop('disabled', false);
                    $('#submit').text();

                    if (data[0] == true) {
                        refreshInstalmentTable();
                        successfully(data);
                        resetErrors();
                        redirect(data);
                    } else {
                        displayMissing(data);
                    }
                },
                error: function (data) {

                    $('#submit').prop('disabled', false);
                    displayErrors(data);

                },
            });

        });
    </script>
@endpush