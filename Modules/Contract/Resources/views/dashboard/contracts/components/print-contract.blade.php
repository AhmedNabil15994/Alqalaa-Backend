@extends('apps::dashboard.layouts.print-invoice')
@section('title' , __('contract::dashboard.contracts.form.contract_installment'))
@section('content')
    <!-- begin invoice-header -->

    @include('contract::dashboard.contracts.components.print-header', ['type' => 'contract'])
    
    <div class="invoice-header" style="text-align: {{is_rtl() == 'rtl'?'right':'left'}}">
        <div class="invoice-from">

            @include('contract::dashboard.contracts.partials.client-address')
        </div>
        <div class="invoice-to">
            <small></small>
            <address class="m-t-5 m-b-5">
                <strong class="text-inverse"></strong><br>

            </address>
        </div>
        <div class="invoice-from">
            <address class="m-t-5 m-b-5">
                <strong class="text-inverse">{{__('contract::dashboard.contracts.show.titles.contract_details')}}
                </strong><br><br>
                <div class="row static-info">
                                <span class="name"> {{__('contract::dashboard.contracts.show.info.contract.id')}}
                                    #:
                                </span>
                    <span class="value">
                                    {{$model->contract_number}}
                                </span>
                </div>
                <div class="row static-info">
                    <span class="name"> {{__('contract::dashboard.contracts.datatable.down_payment')}}
                        :
                    </span>
                    <span class="value"> {{number_format($model->down_payment,2)}}</span>
                </div>
                <div class="row static-info">
                                <span class="name"> {{__('contract::dashboard.contracts.show.info.contract.price')}}
                                    :
                                </span>
                    <span class="value"> {{number_format($model->installment_with_fees,2)}}</span>
                </div>
                <div class="row static-info">
                                <span class="name"> {{__('contract::dashboard.contracts.show.info.contract.instalment_count')}}
                                    :
                                </span>
                    <span class="value"> {{$model->months_num}}</span>
                </div>
                <div class="row static-info">
                                <span class="name"> {{__('contract::dashboard.contracts.datatable.installment_value')}}
                                    :
                                </span>
                    <span class="value"> {{number_format($model->installment_with_fees / $model->months_num,2)}}</span>
                </div>
                <div class="row static-info">
                                <span class="name"> {{__('contract::dashboard.contracts.show.info.contract.created_at')}}
                                    :
                                </span>
                    <span class="value"> {{\Carbon\Carbon::parse($model->created_at)->format('d-m-Y')}}</span>
                </div>
                <div class="row static-info">
                                <span class="name"> {{__('contract::dashboard.contracts.show.info.contract.transaction_date')}}
                                    :
                                </span>
                    <span class="value"> {{\Carbon\Carbon::parse($model->transaction_date)->format('d-m-Y')}}</span>
                </div>
                <div class="row static-info">
                                <span class="name"> {{__('contract::dashboard.contracts.show.info.contract.last_instalment')}}
                                    :
                                </span>
                    <span class="value"> {{\Carbon\Carbon::parse($model->transaction_date)->addMonths($model->months_num - 1)->format('d-m-Y')}}</span>
                </div>

            </address>
        </div>
    </div>
    <!-- end invoice-header -->

    <!-- begin invoice-note -->
    <div class="invoice-note" style="text-align: {{is_rtl() == 'rtl'?'right':'left'}}">
        {!! setting('contract','terms') !!}
    </div>
    <!-- end invoice-note -->

    @include('contract::dashboard.contracts.partials.client-signature')

    @if( !is_null($model->lines) && is_countable($model->lines) && count($model->lines) > 0 )
    <DIV style="page-break-after:always"></DIV>
    @include('contract::dashboard.contracts.partials.logo')
    <br>
    
    @include('contract::dashboard.contracts.components.print-header', ['type' => 'invoice'])

    <div class="invoice-header" style="text-align: {{is_rtl() == 'rtl'?'right':'left'}}">
        <div class="invoice-from">
            @include('contract::dashboard.contracts.partials.client-address')
        </div>
        <div class="invoice-to">
            <strong class="text-inverse">{{__('contract::dashboard.contracts.show.titles.contract_details')}}
            </strong><br><br>
            <div class="row static-info">
                            <span class="name"> {{__('contract::dashboard.contracts.show.info.contract.id')}}
                                #:
                            </span>
                <span class="value">
                                {{$model->contract_number}}
                            </span>
            </div>
            <div class="row static-info">
                <span class="name"> {{__('contract::dashboard.contracts.show.info.contract.price')}}
                    :
                </span>
                <span class="value"> {{number_format($model->installment_with_fees,2)}}</span>
            </div>
            <div class="row static-info">
                            <span class="name"> {{__('contract::dashboard.contracts.show.info.contract.created_at')}}
                                :
                            </span>
                <span class="value"> {{\Carbon\Carbon::parse($model->created_at)->format('d-m-Y')}}</span>
            </div>
        </div>
    </div>
    <br />
    <br />
    
    @include('contract::dashboard.contracts.partials.lines', ['hide_price' => true])
    @include('contract::dashboard.contracts.partials.client-signature')
    @endif
    <br />
    <br />
    <DIV style="page-break-after:always"></DIV>
    {{-- @include('contract::dashboard.contracts.partials.logo') --}}
    <br>
    @include('contract::dashboard.contracts.components.print-header', ['type' => 'insurance'])
    <div style="height: 100% !important; width: 100% !important;">
        @include('contract::dashboard.contracts.partials.insurance-paper')
    </div>
@stop