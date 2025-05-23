@extends('apps::dashboard.layouts.print-invoice')
@section('title' , __('contract::dashboard.contracts.form.contract_installment'))
@section('content')
    <!-- begin invoice-header -->

    @include('contract::dashboard.contracts.components.print-header')
    <br />
    <div class="invoice-header" style="text-align: {{is_rtl() == 'rtl'?'right':'left'}}">
        <div class="invoice-from">

            <address class="m-t-5 m-b-5">
                <strong class="text-inverse">
                    {{__('contract::dashboard.contracts.show.titles.client')}}
                </strong><br><br>
                <div class="invoice-detail">
                    <div class="row static-info">
                                <span class="name"> {{__('contract::dashboard.contracts.show.info.client.name')}}
                                    :
                                </span>
                        <span class="value"> {{optional($model->client)->getTranslation('name','ar')}}</span>
                    </div>
                    <div class="row static-info">
                                <span class="name"> {{__('contract::dashboard.contracts.show.info.client.name-en')}}
                                    :
                                </span>
                        <span class="value"> {{optional($model->client)->getTranslation('name','en')}}</span>
                    </div>
                    <div class="row static-info">
                                <span class="name"> {{__('contract::dashboard.contracts.show.info.client.national_ID')}}
                                    :
                                </span>
                        <span class="value"> {{optional($model->client)->national_ID}}</span>
                    </div>

                    <div class="row static-info">
                                <span class="name"> {{__('contract::dashboard.contracts.show.info.client.phones')}}
                                    :
                                </span>
                        <span class="value">
                                    <div class="well">
                                        @if(optional($model->client->phones())->count())
                                            @foreach($model->client->phones as $phone)
                                                {{$phone->code.$phone->phone}}<br>
                                            @endforeach
                                        @endif
                                    </div>
                                </span>
                    </div>
                    <div class="row static-info">
                        <span class="name"> {{__('contract::dashboard.contracts.show.info.client.address')}}
                            :
                        </span>
                        <span class="value">
                            <span class="label label-primary label-md">
                                {{optional(optional(optional($model->client)->address)->state)->title}}-
                                {{optional(optional($model->client)->address)->street}}
                            </span>
                        </span>
                    </div>
                </div>
            </address>
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

    <!-- begin invoice-price -->
    <div class="invoice-price" style="padding: 14px 48px 68px;">
        <div>
            <div>

                <div style="text-align: right;margin-bottom: 16px;">
                    <h5 class="caption-subject font-orange bold uppercase" style="color: #f5ae1a">
                        {{__('contract::dashboard.contracts.show.titles.second_party')}}
                    </h5>
                </div>
                {{--                <div class="sub-price" style="    text-align: right;">--}}
                {{--                    <h5>({{__('contract::dashboard.contracts.show.titles.second_party')}})</h5>--}}
                {{--                </div>--}}
                <div class="sub-price" style="    float: right;">
                    <span class="text-inverse">{{__('contract::dashboard.contracts.show.titles.client_name')}}</span>
                </div>
                <div class="sub-price">
                    <small>  </small>
                    <span class="text-inverse">{{__('contract::dashboard.contracts.show.titles.client_signature')}}</span>
                </div>
            </div>
        </div>
    </div>
    <!-- end invoice-price -->

    <DIV style="page-break-after:always"></DIV>
    @include('contract::dashboard.contracts.components.print-header')
    <br />
    <br />
    @include('contract::dashboard.contracts.partials.lines', ['hide_price' => true])
    <br />
    <br />
    <DIV style="page-break-after:always"></DIV>
    @include('contract::dashboard.contracts.components.print-header')
    <div style="height: 100% !important">
        @include('contract::dashboard.contracts.partials.insurance-paper')
    </div>
@stop