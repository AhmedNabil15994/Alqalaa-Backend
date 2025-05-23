@extends('apps::dashboard.layouts.app')
@section('title', __('installment::dashboard.installmentpayments.routes.index'))
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
                        <a href="#">{{__('installment::dashboard.installmentpayments.routes.index')}}</a>
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
                                                                    {{__('installment::dashboard.installments.datatable.payment_date')}}
                                                                </label>
                                                                <div id="reportrange" class="btn default form-control">
                                                                    <i class="fa fa-calendar"></i> &nbsp;
                                                                    <span> </span>
                                                                    <b class="fa fa-angle-down"></b>
                                                                    <input type="hidden" name="from">
                                                                    <input type="hidden" name="to">
                                                                </div>
                                                            </div>
                                                        </div>
                                                       
                                                        <div class="col-md-3">
                                                            @inject('users','Modules\User\Entities\User')
                                                            {!! field('dashboard_login')->select('paid_by',__('installment::dashboard.installments.filters.paid_by'),
                                                            $users->pluck('name','id')->toArray())!!}
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
                                {{__('installment::dashboard.installmentpayments.routes.index')}}
                            </span>
                            </div>
                        </div>

                        {{-- DATATABLE CONTENT --}}
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover" id="dataTable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="text-center">{{__('installment::dashboard.installmentpayments.datatable.instalment_id')}}</th>
                                    <th class="text-center">{{__('installment::dashboard.installments.datatable.paid_amount')}}</th>
                                    <th class="text-center">{{__('installment::dashboard.installments.datatable.transaction_date')}}</th>
                                    <th class="text-center">{{__('installment::dashboard.installmentpayments.datatable.payment_method')}}</th>
                                    <th class="text-center">{{__('installment::dashboard.installments.datatable.employee')}}</th>
                                    <th class="text-center">{{__('installment::dashboard.installments.datatable.note')}}</th>
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
        function tableGenerate(data = '') {

            var dataTable =
                $('#dataTable').DataTable({
                    "createdRow": function (row, data, dataIndex) {
                        if (data["deleted_at"] != null) {
                            $(row).addClass('danger');
                        }
                        if (data["id"] === '{{__('contract::dashboard.contracts.datatable.total')}}') {
                            $(row).addClass('success');
                            $(row).addClass('without-hover');
                            $(row).hover(function () {
                                $(row).css("background-color", "transparent");
                            });
                        }
                    },
                    ajax: {
                        url: "{{ url(route('dashboard.installments.payments.datatable')) }}",
                        type: "GET",
                        data: {
                            req: data,
                        },
                    },
                    language: {
                        url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/{{ucfirst(LaravelLocalization::getCurrentLocaleName())}}.json"
                    },
                    stateSave: true,
                    processing: true,
                    serverSide: true,
                    responsive: !0,
                    order: [[1, "desc"]],
                    columns: [
                        {data: 'id', className: 'text-center'},
                        {data: 'installment_id', className: 'text-center'},
                        {data: 'paid_amount', className: 'text-center'},
                        {data: 'transaction_date', className: 'text-center'},
                        {
                            data: 'pay_by_type',
                            className:'text-center',
                            render: function (data, type, full, meta) {
                                switch(data){
                                    case 'by_link':
                                        return '{{__("installment::dashboard.installments.btn.by_link") }}';
                                    case 'by_admin':
                                        return '{{__("installment::dashboard.installments.btn.by_admin") }}';
                                    default:
                                        return '';
                                }
                                
                        },
                        },
                        {data: 'client_name',className:'text-center',
                            render: function (data, type, full, meta) {
                                if(full.pay_by_type != ''){

                                
                                    return full.admin_name;
                                }
                                return '';
                            },
                        },
                        {data: 'note', className: 'text-center'},
                    ],
                    "fnDrawCallback": function() {
                        //Initialize checkbos for enable/disable user
                        $("[name='switch']").bootstrapSwitch({size: "small", onColor:"success", offColor:"danger"});
                    },
                    columnDefs: [
                      
                    ],
                    dom: 'Bfrtip',
                    lengthMenu: [
                        [10, 25, 50, 100, 500],
                        ['10', '25', '50', '100', '500']
                    ],
                buttons: [
                    {
                        extend: "pageLength",
                        className: "btn blue btn-outline",
                        text: "{{__('apps::dashboard.datatable.pageLength')}}",
                        exportOptions: {
                            stripHtml: false,
                            columns: ':visible',
                            columns: [1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: "pdf",
                        className: "btn blue btn-outline",
                        print_type:"queue_file",
                        url: "{{route('dashboard.installments.payments.export' , 'pdf')}}",
                        data: {
                            req: data,
                        },
                        text: "{{__('apps::dashboard.datatable.pdf')}}",
                        exportOptions: {
                            stripHtml: false,
                            columns: ':visible',
                            columns: [1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: "excel",
                        className: "btn blue btn-outline ",
                        url: "{{route('dashboard.installments.payments.export.excel' , 'excel')}}",
                        data: {
                            req: data,
                        },
                        text: "{{__('apps::dashboard.datatable.excel')}}",
                        exportOptions: {
                            stripHtml: false,
                            columns: ':visible',
                            columns: [1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: "colvis",
                        className: "btn blue btn-outline",
                        text: "{{__('apps::dashboard.datatable.colvis')}}",
                        exportOptions: {
                            stripHtml: false,
                            columns: ':visible',
                            columns: [1, 2, 3, 4, 5]
                        }
                    }
                ]
                });
        }

        jQuery(document).ready(function () {
            tableGenerate();
        });
    </script>

@stop
