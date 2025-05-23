@extends('apps::dashboard.layouts.app')
@section('title', __('contract::dashboard.contracts.routes.pending-index'))
@section('css')
    <style>
        table.dataTable.display tbody tr.child {
            background: white;
        }
        table.dataTable.display tbody tr table tr:hover {
            background: none !important;
        }
    </style>
@stop
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
                        <a href="#">{{__('contract::dashboard.contracts.routes.pending-index')}}</a>
                    </li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">

                        <div class="table-toolbar">
                            <div class="row">
                                @can('add_contracts')
                                    <div class="col-lg-1" style="margin: 3px 2px;">
                                        <div class="btn-group">
                                            <a href="{{ url(route('dashboard.contracts.create')) }}"
                                               class="btn sbold green">
                                                <i class="fa fa-plus"></i> {{__('apps::dashboard.buttons.add_new')}}
                                            </a>
                                        </div>
                                    </div>
                                @endcan
                            </div>
                        </div>

                        @include('contract::dashboard.contracts.components.search')

                        <div class="portlet-title">
                            <div class="caption font-dark">
                                <i class="icon-settings font-dark"></i>
                                <span class="caption-subject bold uppercase">
                                                {{__('contract::dashboard.contracts.routes.pending-index')}}
                                            </span>
                            </div>
                        </div>

                        
                        @include('contract::dashboard.contracts.components.table-body')
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    @include('contract::dashboard.contracts.components.table',['datatable_url' => route('dashboard.pending-contracts.datatable'),'exportStatus' => 'pending'])
@stop
