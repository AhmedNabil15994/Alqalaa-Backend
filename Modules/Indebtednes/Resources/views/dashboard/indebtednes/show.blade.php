@extends('apps::dashboard.layouts.app')
@section('title', __('indebtednes::dashboard.indebtednes.routes.index'))
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
                        <a href="{{ url(route('dashboard.indebtednes.index')) }}">
                            {{__('indebtednes::dashboard.indebtednes.routes.index')}}
                        </a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="#">{{__('indebtednes::dashboard.indebtednes.routes.show')}}</a>
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
                                <span class="caption-subject font-dark sbold uppercase"> {{__('indebtednes::dashboard.indebtednes.show.titles.contract')}} #{{$model->indebt_number}}
                                                <span class="hidden-xs">| {{$model->created_at->locale(locale())->isoFormat('dddd  , MMMM  ,  Do / YYYY ')}} </span>
                                            </span>
                            </div>
                            <div class="actions">

                                <div class="btn-group btn-group-devided">

                                    @if($model->is_valid_to_edit)
                                        <a href="{{url(route('dashboard.indebtednes.edit' , $model->id))}}"
                                           class="btn btn-lg green" title="Edit">
                                            <i class="fa fa-edit"></i>
                                            {{__('apps::dashboard.buttons.edit')}}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="tabbable-line">
                                <ul class="nav nav-tabs nav-tabs-lg">
                                    <li>
                                        <a href="#tab_1"
                                           data-toggle="tab"> {{__('indebtednes::dashboard.indebtednes.show.titles.details')}} </a>
                                    </li>
                                    <li class="active">
                                        <a href="#tab_2"
                                           data-toggle="tab"> {{__('indebtednes::dashboard.indebtednes.show.titles.installments')}} </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane" id="tab_1">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="portlet yellow-crusta box">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <i class="fa fa-cogs"></i>{{__('indebtednes::dashboard.indebtednes.show.titles.contract_details')}}
                                                        </div>

                                                        @if($model->is_valid_to_edit)
                                                            <div class="actions">
                                                                <a href="{{url(route('dashboard.indebtednes.edit' , $model->id))}}"
                                                                   class="btn btn-default btn-sm">
                                                                    <i class="fa fa-pencil"></i>
                                                                    {{__('apps::dashboard.buttons.edit')}}
                                                                </a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="portlet-body">
                                                        <div class="row static-info">
                                                            <div class="col-md-5 name"> {{__('indebtednes::dashboard.indebtednes.show.titles.indebtednes_id')}}
                                                                #:
                                                            </div>
                                                            <div class="col-md-7 value">
                                                                {{$model->indebt_number}}
                                                            </div>
                                                        </div>
                                                        <div class="row static-info">
                                                            <div class="col-md-5 name"> {{__('indebtednes::dashboard.indebtednes.datatable.transaction_date')}}
                                                                :
                                                            </div>
                                                            <div class="col-md-7 value"> {{date('d-m-Y', strtotime($model->transaction_date))}}</div>
                                                        </div>
                                                        <div class="row static-info">
                                                            <div class="col-md-5 name"> {{__('indebtednes::dashboard.indebtednes.datatable.price')}}
                                                                :
                                                            </div>
                                                            <div class="col-md-7 value"> {{$model->price}}</div>
                                                        </div>
                                                        <div class="row static-info">
                                                            <div class="col-md-5 name"> {{__('indebtednes::dashboard.indebtednes.datatable.remaining')}}
                                                                :
                                                            </div>
                                                            <div class="col-md-7 value"> {{$model->total_installment_remaining}}</div>
                                                        </div>
                                                        <div class="row static-info">
                                                            <div class="col-md-5 name"> {{__('indebtednes::dashboard.indebtednes.datatable.paid')}}
                                                                :
                                                            </div>
                                                            <div class="col-md-7 value"> {{(float)$model->total_paid}}</div>
                                                        </div>
                                                        <div class="row static-info">
                                                            <div class="col-md-5 name"> {{__('indebtednes::dashboard.indebtednes.datatable.completed_at')}}
                                                                :
                                                            </div>
                                                            <div class="col-md-7 value">
                                                                @if($model->completed_at)
                                                                    <span class="label label-success label-sm"> {{date('d-m-Y', strtotime($model->completed_at))}} </span>
                                                                @else
                                                                    <span class="label label-danger label-sm"> {{__('indebtednes::dashboard.indebtednes.datatable.not_completed')}} </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row static-info">
                                                            <div class="col-md-5 name"> {{__('indebtednes::dashboard.indebtednes.datatable.type')}}
                                                                :
                                                            </div>
                                                            <div class="col-md-7 value">
                                                                @if(!$model->is_case_action)
                                                                    <span class="label label-success label-sm"> {{__('indebtednes::dashboard.indebtednes.datatable.indebtednes')}} </span>
                                                                @else
                                                                    <span class="label label-danger label-sm"> {{__('indebtednes::dashboard.indebtednes.datatable.case_action')}} </span>
                                                                @endif
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
                                                            {{__('indebtednes::dashboard.indebtednes.show.titles.client')}}
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
                                                            <div class="col-md-5 name"> {{__('indebtednes::dashboard.indebtednes.show.info.client.name')}}
                                                                :
                                                            </div>
                                                            <div class="col-md-7 value"> {{optional($model->client)->name}}</div>
                                                        </div>
                                                        <div class="row static-info">
                                                            <div class="col-md-5 name"> {{__('indebtednes::dashboard.indebtednes.show.info.client.nationality')}}
                                                                :
                                                            </div>
                                                            <div class="col-md-7 value"> {{optional(optional($model->client)->nationality)->title}}</div>
                                                        </div>
                                                        <div class="row static-info">
                                                            <div class="col-md-5 name"> {{__('indebtednes::dashboard.indebtednes.show.info.client.national_ID')}}
                                                                :
                                                            </div>
                                                            <div class="col-md-7 value"> {{optional($model->client)->national_ID}}</div>
                                                        </div>
                                                        <div class="row static-info">
                                                            <div class="col-md-5 name"> {{__('indebtednes::dashboard.indebtednes.show.info.client.email')}}
                                                                :
                                                            </div>
                                                            <div class="col-md-7 value"> {{optional($model->client)->email}}</div>
                                                        </div>
                                                        <div class="row static-info">
                                                            <div class="col-md-5 name"> {{__('indebtednes::dashboard.indebtednes.show.info.client.address')}}
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
                                                            <div class="col-md-5 name"> {{__('indebtednes::dashboard.indebtednes.show.info.client.status')}}
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
                                                            <div class="col-md-5 name"> {{__('indebtednes::dashboard.indebtednes.show.info.client.is_judging')}}
                                                                :
                                                            </div>
                                                            <div class="col-md-7 value">
                                                                @if (optional($model->client)->is_judging)
                                                                    <span class="badge badge-danger"> {{__('indebtednes::dashboard.indebtednes.show.info.client.in_judging')}} </span>
                                                                @else
                                                                    <span class="badge badge-success"> {{__('indebtednes::dashboard.indebtednes.show.info.client.out_judging')}} </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row static-info">
                                                            <div class="col-md-5 name"> {{__('indebtednes::dashboard.indebtednes.show.info.client.phones')}}
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
                                                            <i class="fa fa-cogs"></i>{{__('indebtednes::dashboard.indebtednes.show.titles.instalments_details')}}
                                                        </div>
                                                    </div>
                                                    <div class="portlet-body">

                                                        <div class="row static-info">
                                                            <div class="col-md-5 name">
                                                                {{__('indebtednes::dashboard.indebtednes.show.info.instalments_details.total_remaining')}}
                                                                :
                                                            </div>
                                                            <div class="col-md-7 value"> {{$model->total_installment_remaining}}</div>
                                                        </div>

                                                        <div class="row static-info">
                                                            <div class="col-md-5 name">
                                                                {{__('indebtednes::dashboard.indebtednes.show.info.instalments_details.total_paid')}}
                                                                :
                                                            </div>
                                                            <div class="col-md-7 value"> {{$model->total_paid}}</div>
                                                        </div>

                                                        <div class="row static-info">
                                                            <div class="col-md-5 name">
                                                                {{__('indebtednes::dashboard.indebtednes.show.info.instalments_details.paid_count')}}
                                                                :
                                                            </div>
                                                            <div class="col-md-7 value"> {{$model->installments()->count()}}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane active" id="tab_2">
                                        @include('indebtednes::dashboard.indebtednes.components.instalment-table')
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

@stop

@push('scripts')
    <script>
        $("#myModal").on("hidden", function () {
            $('#result').html('yes,result');
        });

        function refreshInstalmentTable() {
            $.ajax({
                url: '{{url(route('dashboard.indebtednes.refresh.table',$model->id))}}',
                type: 'get',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    $("#error_message").hide();
                    $('#tab_2').text('').append(data.table);
                },
            });
        }

        function cancelPay(url) {
            $(".modal").modal('hide');
            swal({
                title: "{{__('indebtednes::dashboard.indebtednes.show.titles.are_you_sure_cancel_pay')}}",
                icon: "warning",
                buttons: {
                    cancel: {
                        text: '{{__('indebtednes::dashboard.indebtednes.show.btn.cancel')}}',
                        value: false,
                        visible: true,
                        className: "",
                        closeModal: true,
                    },
                    confirm: {
                        text: '{{__('indebtednes::dashboard.indebtednes.show.btn.confirm')}}',
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
                        type: 'PUT',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
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
                        $(".modal").modal('hide');
                        refreshInstalmentTable();
                        redirect(data);
                        successfully(data);
                        resetErrors();
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