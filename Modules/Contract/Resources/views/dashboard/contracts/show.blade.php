@extends('apps::dashboard.layouts.app')
@section('title', __('contract::dashboard.contracts.routes.index'))
@section('content')

    <div class="page-content-wrapper">

        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{ url(route('dashboard.home')) }}">{{ __('apps::dashboard.index.title') }}</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="{{ url(route('dashboard.contracts.index')) }}">
                            {{__('contract::dashboard.contracts.routes.index')}}
                        </a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="#">{{__('contract::dashboard.contracts.routes.show')}}</a>
                    </li>
                </ul>
            </div>

            <h1 class="page-title"></h1>

            <div class="row">
                <div class="col-md-12">

                @include('apps::dashboard.layouts._ajax-msg')
                <!-- Begin: life time stats -->
                    <div class="portlet light portlet-fit portlet-datatable bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-settings font-dark"></i>
                                <span class="caption-subject font-dark sbold uppercase"> {{__('contract::dashboard.contracts.show.titles.contract')}} #{{$model->contract_number}}
                                                <span class="hidden-xs">| {{$model->created_at->locale(locale())->isoFormat('dddd  , MMMM  ,  Do / YYYY ')}} </span>
                                            </span>
                            </div>
                            <div class="actions">

                                <div class="btn-group btn-group-devided">

                                    @if($model->is_valid_to_edit)
                                        <a href="{{url(route('dashboard.contracts.edit' , $model->id))}}"
                                           class="btn btn-lg green" title="Edit">
                                            <i class="fa fa-edit"></i>
                                            {{__('apps::dashboard.buttons.edit')}}
                                        </a>
                                    @endif
                                    <button class="btn btn-lg blue hidden-print" onclick="printFromUrl('{{route('dashboard.contracts.print' , $model->id)}}')">
                                        <i class="fa fa-print"></i>
                                        {{__('apps::dashboard.buttons.print')}}
                                    </button>
                                        <button class="btn btn-lg blue hidden-print" onclick="printFromUrl('{{route('dashboard.contracts.printIndebtednessCertificate' , $model->id)}}')">
                                            <i class="fa fa-print"></i>
                                            {{__('apps::dashboard.buttons.print_indebtedness_certificate')}}
                                        </button>
                                </div>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="tabbable-line">
                                <ul class="nav nav-tabs nav-tabs-lg">
                                    <li class="active">
                                        <a href="#tab_1"
                                           data-toggle="tab"> {{__('contract::dashboard.contracts.show.titles.details')}} </a>
                                    </li>
                                    @if($model->can_pay_installment)
                                        <li>
                                            <a href="#tab_2"
                                            data-toggle="tab"> {{__('contract::dashboard.contracts.show.titles.installments')}} </a>
                                        </li>
                                    @endif
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="portlet yellow-crusta box">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <i class="fa fa-cogs"></i>{{__('contract::dashboard.contracts.show.titles.contract_details')}}
                                                        </div>

                                                        @if($model->is_valid_to_edit)
                                                            <div class="actions">
                                                                <a href="{{url(route('dashboard.contracts.edit' , $model->id))}}"
                                                                   class="btn btn-default btn-sm">
                                                                    <i class="fa fa-pencil"></i>
                                                                    {{__('apps::dashboard.buttons.edit')}}
                                                                </a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="portlet-body">
                                                        <div class="row static-info">
                                                            <div class="col-md-5 name"> {{__('contract::dashboard.contracts.show.titles.contract')}}
                                                                #:
                                                            </div>
                                                            <div class="col-md-7 value">
                                                                {{$model->contract_number}}
                                                            </div>
                                                        </div>
                                                        <div class="row static-info">
                                                            <div class="col-md-5 name"> {{__('contract::dashboard.contracts.datatable.transaction_date')}}
                                                                :
                                                            </div>
                                                            <div class="col-md-7 value"> {{date('d-m-Y', strtotime($model->transaction_date))}}</div>
                                                        </div>

                                                        @can('show_contract_amount')
                                                            <div class="row static-info">
                                                                <div class="col-md-5 name"> {{__('contract::dashboard.contracts.datatable.price')}}
                                                                    :
                                                                </div>
                                                                <div class="col-md-7 value"> {{$model->price}}</div>
                                                            </div>
                                                        @endcan

                                                        @can('show_contract_down_payment')
                                                            <div class="row static-info">
                                                                <div class="col-md-5 name"> {{__('contract::dashboard.contracts.datatable.down_payment')}}
                                                                    :
                                                                </div>
                                                                <div class="col-md-7 value"> {{$model->down_payment}}</div>
                                                            </div>
                                                        @endcan

                                                        <div class="row static-info">
                                                            <div class="col-md-5 name"> {{__('contract::dashboard.contracts.datatable.remaining')}}
                                                                :
                                                            </div>
                                                            <div class="col-md-7 value"> {{$model->remaining}}</div>
                                                        </div>

                                                        @can('show_installment_fees')
                                                            <div class="row static-info">
                                                                <div class="col-md-5 name"> {{__('contract::dashboard.contracts.datatable.installment_fees')}}
                                                                    :
                                                                </div>
                                                                <div class="col-md-7 value"> {{$model->installment_fees}}
                                                                    %
                                                                </div>
                                                            </div>
                                                        @endcan

                                                        <div class="row static-info">
                                                            <div class="col-md-5 name"> {{__('contract::dashboard.contracts.datatable.installment_with_fees')}}
                                                                :
                                                            </div>
                                                            <div class="col-md-7 value"> {{$model->installment_with_fees}}</div>
                                                        </div>
                                                        <div class="row static-info">
                                                            <div class="col-md-5 name"> {{__('contract::dashboard.contracts.datatable.months_num')}}
                                                                :
                                                            </div>
                                                            <div class="col-md-7 value"> {{$model->months_num}}</div>
                                                        </div>
                                                        <div class="row static-info">
                                                            <div class="col-md-5 name"> {{__('contract::dashboard.contracts.datatable.installment_value')}}
                                                                :
                                                            </div>
                                                            <div class="col-md-7 value"> {{$model->installment_value}}</div>
                                                        </div>

                                                        @can('show_contract_paid_amount')
                                                            <div class="row static-info">
                                                                <div class="col-md-5 name"> {{__('contract::dashboard.contracts.datatable.paid')}}
                                                                    :
                                                                </div>
                                                                <div class="col-md-7 value"> {{$model->total_installment_paid}}</div>
                                                            </div>
                                                        @endcan

                                                        @can('show_contract_profit')
                                                            <div class="row static-info">
                                                                <div class="col-md-5 name"> {{__('contract::dashboard.contracts.datatable.profit')}}
                                                                    :
                                                                </div>
                                                                <div class="col-md-7 value"><span
                                                                            class="label label-primary label-sm">{{$model->profit}}</span>
                                                                </div>
                                                            </div>
                                                        @endcan
                                                        <div class="row static-info">
                                                            <div class="col-md-5 name"> {{__('contract::dashboard.contracts.datatable.completed_at')}}
                                                                :
                                                            </div>
                                                            <div class="col-md-7 value">
                                                                @if($model->completed_at)
                                                                    <span class="label label-success label-sm"> {{date('d-m-Y', strtotime($model->completed_at))}} </span>
                                                                @else
                                                                    <span class="label label-danger label-sm"> {{__('contract::dashboard.contracts.datatable.not_completed')}} </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row static-info">
                                                            <div class="col-md-5 name"> {{__('Note')}}
                                                                :
                                                            </div>
                                                            <br>
                                                            <div class="col-md-12 value">
                                                                {!! $model->note !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="portlet blue-hoki box">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <i class="fa fa-cogs"></i>
                                                            {{__('contract::dashboard.contracts.show.titles.client')}}
                                                        </div>
                                                        <div class="actions">
                                                            <a href="{{url(route('dashboard.clients.edit' , $model->client_id))}}"
                                                               class="btn btn-default btn-sm">
                                                                <i class="fa fa-pencil"></i>
                                                                {{__('apps::dashboard.buttons.edit')}}
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body">
                                                        <div class="row static-info">
                                                            <div class="col-md-5 name"> {{__('contract::dashboard.contracts.show.info.client.name')}}
                                                                :
                                                            </div>
                                                            <div class="col-md-7 value"> {{optional($model->client)->name}}</div>
                                                        </div>
                                                        <div class="row static-info">
                                                            <div class="col-md-5 name"> {{__('contract::dashboard.contracts.show.info.client.nationality')}}
                                                                :
                                                            </div>
                                                            <div class="col-md-7 value"> {{optional(optional($model->client)->nationality)->title}}</div>
                                                        </div>
                                                        <div class="row static-info">
                                                            <div class="col-md-5 name"> {{__('contract::dashboard.contracts.show.info.client.national_ID')}}
                                                                :
                                                            </div>
                                                            <div class="col-md-7 value"> {{optional($model->client)->national_ID}}</div>
                                                        </div>
                                                        <div class="row static-info">
                                                            <div class="col-md-5 name"> {{__('contract::dashboard.contracts.show.info.client.email')}}
                                                                :
                                                            </div>
                                                            <div class="col-md-7 value"> {{optional($model->client)->email}}</div>
                                                        </div>
                                                        <div class="row static-info">
                                                            <div class="col-md-5 name"> {{__('contract::dashboard.contracts.show.info.client.address')}}
                                                                :
                                                            </div>
                                                            <div class="col-md-7 value">
                                                                <span class="label label-primary label-md">
                                                                    {{optional(optional(optional($model->client)->address)->state)->title}}-
                                                                    {{optional(optional($model->client)->address)->street}}
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="row static-info">
                                                            <div class="col-md-5 name"> {{__('contract::dashboard.contracts.show.info.client.status')}}
                                                                :
                                                            </div>
                                                            <div class="col-md-7 value">
                                                                @if (optional($model->client)->status)
                                                                    <span class="badge badge-success"> {{__('apps::dashboard.datatable.active')}} </span>
                                                                @else
                                                                    <span class="badge badge-danger"> {{__('apps::dashboard.datatable.unactive')}} </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row static-info">
                                                            <div class="col-md-5 name"> {{__('contract::dashboard.contracts.show.info.client.is_judging')}}
                                                                :
                                                            </div>
                                                            <div class="col-md-7 value">
                                                                @if (optional($model->client)->is_judging)
                                                                    <span class="badge badge-danger"> {{__('contract::dashboard.contracts.show.info.client.in_judging')}} </span>
                                                                @else
                                                                    <span class="badge badge-success"> {{__('contract::dashboard.contracts.show.info.client.out_judging')}} </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row static-info">
                                                            <div class="col-md-5 name"> {{__('contract::dashboard.contracts.show.info.client.phones')}}
                                                                :
                                                            </div>
                                                            <div class="col-md-7 value">
                                                                <div class="well">
                                                                    @if(optional($model->client->phones())->count())
                                                                        @foreach($model->client->phones as $phone)
                                                                            {{$phone->code.$phone->phone}}<br>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12">
                                                <div class="portlet grey-cascade box">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <i class="fa fa-cogs"></i>{{__('contract::dashboard.contracts.show.titles.instalments_details')}}
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body">

                                                        <div class="row static-info">
                                                            <div class="col-md-5 name">
                                                                {{__('contract::dashboard.contracts.show.info.instalments_details.total_remaining')}}
                                                                :
                                                            </div>
                                                            <div class="col-md-7 value"> {{$model->total_installment_remaining}}</div>
                                                        </div>

                                                        <div class="row static-info">
                                                            <div class="col-md-5 name">
                                                                {{__('contract::dashboard.contracts.show.info.instalments_details.total_paid')}}
                                                                :
                                                            </div>
                                                            <div class="col-md-7 value"> {{$model->total_installment_paid}}</div>
                                                        </div>

                                                        <div class="row static-info">
                                                            <div class="col-md-5 name">
                                                                {{__('contract::dashboard.contracts.show.info.instalments_details.remaining_count')}}
                                                                :
                                                            </div>
                                                            <div class="col-md-7 value"> {{$model->installment_remaining_count}}</div>
                                                        </div>

                                                        <div class="row static-info">
                                                            <div class="col-md-5 name">
                                                                {{__('contract::dashboard.contracts.show.info.instalments_details.paid_count')}}
                                                                :
                                                            </div>
                                                            <div class="col-md-7 value"> {{$model->installment_paid_count}}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if( !is_null($model->lines) && is_countable($model->lines) && count($model->lines) > 0 )
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="portlet grey-cascade box">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <i class="fa fa-cogs"></i>{{__('contract::dashboard.contracts.show.titles.contract_details')}}
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body">
                                                        @include('contract::dashboard.contracts.partials.lines', ['hide_price' => false])
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>

                                    @if($model->can_pay_installment)
                                        <div class="tab-pane" id="tab_2">
                                            <div class="table-container" style="">
                                                @if($model->installments->count())
                                                    <div class="portlet light bordered">
                                                        <div class="portlet-title">
                                                            <div class="caption">
                                                                <i class="icon-social-dribbble font-blue"></i>
                                                                <span class="caption-subject font-blue bold uppercase">{{__('contract::dashboard.contracts.show.titles.instalments')}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="portlet-body" id="instalment-table">
                                                            @include('contract::dashboard.contracts.components.instalment-table')
                                                        </div>
                                                    </div>

                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End: life time stats -->
                </div>
            </div>
        </div>
    </div>


    @can('pay_installments')
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
                            {{__('contract::dashboard.contracts.show.btn.pay_installment')}}
                        </h4>
                    </div>
                    <div class="modal-body">
                        {!! Form::open([
                            'url' => url(route('dashboard.installments.update','::id')),
                            'id'=>'instalment-form',
                            'method' => 'put',
                        ]) !!}

                        <input type="hidden" name="contract_id"  value="{{$model->id}}">
                        {!! field()->number('' ,__('contract::client.contracts.show.info.instalments_details.contract_id'), $model->contract_number , ['readonly' => 'readonly']) !!}
                        {!! field()->number('amount' ,__('contract::dashboard.contracts.show.info.instalments_details.total_amount') , '::amount' , ['readonly' => 'readonly']) !!}
                        {!! field()->number('paid' ,__('contract::dashboard.contracts.show.info.instalments_details.paid_amount') , '::paid' , ['readonly' => 'readonly']) !!}
                        {!! field()->number('remaining' ,__('contract::dashboard.contracts.show.info.instalments_details.remaining_amount') , '::remaining' , ['readonly' => 'readonly']) !!}
                        {!! field()->number('pay_now' ,__('contract::dashboard.contracts.show.info.instalments_details.paid_amount') , '::remaining',['step'=> '0.001']) !!}
                        {!! field()->date('transaction_date' ,__('contract::dashboard.contracts.show.info.instalments_details.transaction_date')) !!}
                        {!! field()->textarea('note',__('contract::dashboard.contracts.show.info.instalments_details.note'),null,['class' => 'form-control']) !!}
                    </div>
                    <div class="modal-footer">
                        <div class="clearfix"></div>
                        <br>
                        <button type="button"
                                class="btn btn-white"
                                data-dismiss="modal">
                            {{__('contract::dashboard.contracts.show.btn.cancel')}}
                        </button>
                        {!! Form::submit('حفظ',[
                            'class' => 'btn btn-primary'
                            ]) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    @endcan
@stop

@push('scripts')
    <script>

        function printFromUrl(url) {


            $("<iframe>").hide().attr("src", url).appendTo("body");
        }

        function openPayModel(data) {

            @can('pay_installments')
            resetErrors();
            var $form = $('#instalment-form');
            var url = '{{ route('dashboard.installments.update',':id') }}';
            url = url.replace(':id', data.id);
            $form.attr('action', url);
            $('#amount').val(data.amount);
            $('#paid').val(data.paid);
            $('#remaining').val(data.remaining);
            $('#pay_now').val(data.remaining);
            $("#pay-installment").modal('show');
            @endcan
        }

        function refreshInstalmentTable() {
            $.ajax({
                url: '{{url(route('dashboard.contracts.refresh.table',$model->id))}}',
                type: 'get',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data){
                    $('#instalment-table').text('').append(data.table);
                    $(".modal").modal('hide');
                },
            });
        }

        function cancelPay(url) {
            $(".modal").modal('hide');
            swal({
                title: "{{__('contract::dashboard.contracts.show.titles.are_you_sure_cancel_pay')}}",
                icon: "warning",
                buttons: {
                    cancel: {
                        text: '{{__('contract::dashboard.contracts.show.btn.cancel')}}',
                        value: false,
                        visible: true,
                        className: "",
                        closeModal: true,
                    },
                    confirm: {
                        text: '{{__('contract::dashboard.contracts.show.btn.confirm')}}',
                        value: true,
                        visible: true,
                        className: "",
                        closeModal: true
                    }
                },
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {

                    $.ajax({
                        url: url,
                        type: 'get',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (data) {

                            if (data[0] === true) {
                                successfully(data);
                                refreshInstalmentTable();
                            } else {
                                displayMissing(data);
                            }
                        },
                    });
                }
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
