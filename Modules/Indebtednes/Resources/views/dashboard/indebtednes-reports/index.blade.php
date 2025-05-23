@extends('apps::dashboard.layouts.app')
@section('title', __('indebtednes::dashboard.indebtednes-reports.routes.index'))
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
                        <a href="#">{{__('indebtednes::dashboard.indebtednes-reports.routes.index')}}</a>
                    </li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">

                        {{-- DATATABLE FILTER --}}
                        <div class="row">
                            <div class="portlet box grey-cascade">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>
                                        {{__('apps::dashboard.datatable.search')}}
                                    </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div id="filter_data_table">
                                        <div class="panel-body">
                                            <form id="formFilter" class="horizontal-form">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    {{__('apps::dashboard.datatable.form.date_range')}}
                                                                </label>
                                                                <div id="reportrange" class="btn default form-control">
                                                                    <i class="fa fa-calendar"></i> &nbsp;
                                                                    <span> </span>
                                                                    <b class="fa fa-angle-down"></b>
                                                                    <input type="hidden" name="from">
                                                                    <input type="hidden" name="to">
                                                                </div>
                                                            </div>
                                                            <br>
                                                        </div>
                                                        <div class="col-md-3">
                                                            @include('user::dashboard.clients.components.select-search.index')
                                                            <br>
                                                        </div>
                                                        <div class="col-md-3">
                                                            {!! field('readonly')->select('contract_id',__('indebtednes::dashboard.indebtednes-reports.filters.contract_id'),[])!!}
                                                            <br>
                                                            @push('scripts')
                                                                <script>
                                                                    $('#client_id').change(function () {
                                                                        var url = '{!! url(route('dashboard.indebtednes.get-with-client-id',':client')) !!}';
                                                                        url = url.replace(':client', $('#client_id').val());

                                                                        $.ajax({
                                                                            url: url,
                                                                            type: 'get',
                                                                            success: function (data) {

                                                                                var builtSelectCategory = '<option value="" selected>قم بالاخيتار</option>';
                                                                                $.each(data, function (index, item) {
                                                                                    var option = '<option value="' + item.id + '">' + item.id + '</option>';
                                                                                    builtSelectCategory += option;
                                                                                });

                                                                                $('#contract_id').text('').append(builtSelectCategory);
                                                                            },
                                                                        });
                                                                    });
                                                                </script>
                                                            @endpush
                                                        </div>

                                                        <div class="clearfix"></div>
                                                        <div class="col-md-3">
                                                            {!! field('search')->select('status',
                                                            __('indebtednes::dashboard.indebtednes-reports.filters.status'),[
                                                                'all' => __('indebtednes::dashboard.indebtednes-reports.datatable.all'),
                                                                'waiting' => __('indebtednes::dashboard.indebtednes-reports.datatable.waiting'),
                                                                'not_complete' => __('indebtednes::dashboard.indebtednes-reports.datatable.not_complete'),
                                                                'completed' => __('indebtednes::dashboard.indebtednes-reports.datatable.completed'),
                                                            ],null,['class' => 'form-control','style'=>'padding: 0px'])!!}
                                                            <br>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="form-actions">
                                                <button class="btn btn-sm green btn-outline filter-submit margin-bottom"
                                                        id="search">
                                                    <i class="fa fa-search"></i>
                                                    {{__('apps::dashboard.datatable.search')}}
                                                </button>
                                                <button class="btn btn-sm red btn-outline filter-cancel">
                                                    <i class="fa fa-times"></i>
                                                    {{__('apps::dashboard.datatable.reset')}}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- END DATATABLE FILTER --}}

                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-settings font-dark"></i>
                                <span class="caption-subject bold uppercase">
                                {{__('indebtednes::dashboard.indebtednes-reports.routes.index')}}
                            </span>
                            </div>
                        </div>

                        {{-- DATATABLE CONTENT --}}
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover" id="dataTable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="text-center">{{__('indebtednes::dashboard.indebtednes-reports.datatable.contract_id')}}</th>
                                    <th class="text-center">{{__('indebtednes::dashboard.indebtednes-reports.datatable.client')}}</th>
                                    <th class="text-center">{{__('indebtednes::dashboard.indebtednes-reports.datatable.paid_amount')}}</th>
                                    <th class="text-center">{{__('indebtednes::dashboard.indebtednes-reports.datatable.transaction_date')}}</th>
                                    <th class="text-center">{{__('indebtednes::dashboard.indebtednes-reports.datatable.status')}}</th>
                                    <th class="text-center">{{__('indebtednes::dashboard.indebtednes-reports.datatable.details')}}</th>
                                    <th class="text-center">{{__('indebtednes::dashboard.indebtednes-reports.datatable.pay')}} </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>

        function cancelPay(url) {
            swal({
                title: "{{__('indebtednes::dashboard.indebtednes-reports.titles.are_you_sure_cancel_pay')}}",
                icon: "warning",
                buttons: {
                    cancel: {
                        text: '{{__('indebtednes::dashboard.indebtednes-reports.btn.cancel')}}',
                        value: false,
                        visible: true,
                        className: "",
                        closeModal: true,
                    },
                    confirm: {
                        text: '{{__('indebtednes::dashboard.indebtednes-reports.btn.confirm')}}',
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

        function refreshInstalmentTable() {
            $('#dataTable').DataTable().destroy();
            tableGenerate();
        }
    </script>
    @include('indebtednes::dashboard.indebtednes-reports.components.table')
@stop
