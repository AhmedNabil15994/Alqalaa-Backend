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
                        <a href="#">{{__('contract::client.contracts.routes.index')}}</a>
                    </li>
                    <h1 class="page-title"> {{ __('apps::client.index.welcome') }} ,
                        <small><b style="color:red">{{ auth('client')->user()->name }} </b></small>
                    </h1>
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
                                        {{__('apps::client.datatable.search')}}
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
                                                                    {{__('apps::client.datatable.form.date_range')}}
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
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="form-actions">
                                                <button class="btn btn-sm green btn-outline filter-submit margin-bottom"
                                                        id="search">
                                                    <i class="fa fa-search"></i>
                                                    {{__('apps::client.datatable.search')}}
                                                </button>
                                                <button class="btn btn-sm red btn-outline filter-cancel">
                                                    <i class="fa fa-times"></i>
                                                    {{__('apps::client.datatable.reset')}}
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
                                {{__('contract::client.contracts.routes.index')}}
                            </span>
                            </div>
                        </div>

                        {{-- DATATABLE CONTENT --}}
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover" id="dataTable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('contract::client.contracts.datatable.installment_with_fees')}}</th>
                                    <th>{{__('contract::client.contracts.datatable.months_num')}}</th>
                                    <th>{{__('contract::client.contracts.datatable.installment_value')}}</th>
                                    <th>{{__('contract::client.contracts.datatable.paid')}}</th>
                                    <th>{{__('contract::client.contracts.datatable.remaining')}}</th>
                                    <th>{{__('contract::client.contracts.datatable.completed_at')}}</th>
                                    <th>{{__('contract::client.contracts.datatable.created_at')}}</th>
                                    <th>{{__('contract::client.contracts.datatable.options')}}</th>
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
        @if(session()->get('success'))
        swal({
            icon: "success",
            title: "{{__('contract::client.contracts.show.titles.success_transaction')}}",
            type: "success",
        });
        @elseif(session()->get('error'))
        swal({
            icon: "error",
            title: "{{__('contract::client.contracts.show.titles.error_transaction')}}",
            type: "error",
        });
        @endif
    </script>
    @include('contract::client.contracts.components.table')
@stop
