@extends('apps::dashboard.layouts.print-invoice')
@section('title' , __('indebtednes::dashboard.indebtednes.form.indebtednes_installment'))
@section('content')
    <!-- begin invoice-header -->

    <div class="clearfix" style="width: 100%"></div>
    <center>
        <h2 class="caption-subject font-orange bold uppercase" style="color: #f5ae1a">
            {{__('indebtednes::dashboard.indebtednes.show.info.indebtednes.indebtednes_a_deal')}}
        </h2>
    </center>
    <div class="invoice-header" style="text-align: {{is_rtl() == 'rtl'?'right':'left'}}">
        <div class="invoice-from">

            <address class="m-t-5 m-b-5">
                <strong class="text-inverse">
                    {{__('indebtednes::dashboard.indebtednes.show.titles.client')}}
                </strong><br><br>
                <div class="invoice-detail">
                    <div class="row static-info">
                                <span class="name"> {{__('indebtednes::dashboard.indebtednes.show.info.client.name')}}
                                    :
                                </span>
                        <span class="value"> {{optional($model->client)->getTranslation('name','ar')}}</span>
                    </div>
                    <div class="row static-info">
                                <span class="name"> {{__('indebtednes::dashboard.indebtednes.show.info.client.name-en')}}
                                    :
                                </span>
                        <span class="value"> {{optional($model->client)->getTranslation('name','en')}}</span>
                    </div>
                    <div class="row static-info">
                                <span class="name"> {{__('indebtednes::dashboard.indebtednes.show.info.client.national_ID')}}
                                    :
                                </span>
                        <span class="value"> {{optional($model->client)->national_ID}}</span>
                    </div>

                    <div class="row static-info">
                                <span class="name"> {{__('indebtednes::dashboard.indebtednes.show.info.client.phones')}}
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
                        <span class="name"> {{__('indebtednes::dashboard.indebtednes.show.info.client.address')}}
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
                <strong class="text-inverse">{{__('indebtednes::dashboard.indebtednes.show.titles.indebtednes_details')}}
                </strong><br><br>
                <div class="row static-info">
                                <span class="name"> {{__('indebtednes::dashboard.indebtednes.show.info.indebtednes.id')}}
                                    #:
                                </span>
                    <span class="value">
                                    {{$model->indebt_number}}
                                </span>
                </div>
                <div class="row static-info">
                                <span class="name"> {{__('indebtednes::dashboard.indebtednes.show.info.indebtednes.price')}}
                                    :
                                </span>
                    <span class="value"> {{number_format($model->price,1)}}</span>
                </div>
                <div class="row static-info">
                                <span class="name"> {{__('indebtednes::dashboard.indebtednes.show.info.instalments_details.total_paid')}}
                                    :
                                </span>
                    <span class="value"> {{number_format($model->total_paid,1)}}</span>
                </div>
                <div class="row static-info">
                                <span class="name"> {{__('indebtednes::dashboard.indebtednes.show.info.indebtednes.created_at')}}
                                    :
                                </span>
                    <span class="value"> {{\Carbon\Carbon::parse($model->created_at)->format('d-m-Y')}}</span>
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
    <div class="invoice-price" style="margin-bottom:0; padding: 14px 48px 68px;">
        <div>
            <div>

                <div style="text-align: right;margin-bottom: 16px;">
                    <h5 class="caption-subject font-orange bold uppercase" style="color: #f5ae1a">
                        {{__('indebtednes::dashboard.indebtednes.show.titles.second_party')}}
                    </h5>
                </div>
                {{--                <div class="sub-price" style="    text-align: right;">--}}
                {{--                    <h5>({{__('indebtednes::dashboard.indebtednes.show.titles.second_party')}})</h5>--}}
                {{--                </div>--}}
                <div class="sub-price" style="    float: right;">
                    <span class="text-inverse">{{__('indebtednes::dashboard.indebtednes.show.titles.client_name')}}</span>
                </div>
                <div class="sub-price">
                    <small></small>
                    <span class="text-inverse">{{__('indebtednes::dashboard.indebtednes.show.titles.client_signature')}}</span>
                </div>
            </div>
        </div>
    </div>
    <!-- end invoice-price -->
@stop