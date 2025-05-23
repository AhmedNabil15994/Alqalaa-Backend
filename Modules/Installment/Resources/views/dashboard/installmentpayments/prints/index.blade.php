<!DOCTYPE html>
<html lang="{{ locale() }}" dir="{{ is_rtl() }}">
<head>
    <style>
        @font-face {
            font-family: 'Cairo';
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@200;400;500&display=swap');
        }

        body {
            font-family: 'Cairo', sans-serif !important;
            border: double;
            font-size: 12px !important;
            font-weight: 500;
        }

        #customers {
            font-family: 'Cairo', sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }

        @page {
            header: page-header;
            footer: page-footer;
        }

        @page :first {
            header: firstpage;
        }
    </style>

    <style type="text/css">
        body {
            margin-top: 20px;
            background: white;
        }

        .invoice {
            background: #fff;
            padding: 20px
        }

        .invoice-company {
            font-size: 20px
        }

        .invoice-header {
            margin: 0 -20px;
            background: #f0f3f4;
            padding: 20px 37px
        }

        .invoice-date,
        .invoice-from,
        .invoice-to {
            display: table-cell;
            width: 1%
        }

        .invoice-from,
        .invoice-to {
            padding-right: 20px
        }

        .invoice-date .date,
        .invoice-from strong,
        .invoice-to strong {
            font-size: 16px;
            font-weight: 600
        }

        .invoice-date {
            text-align: right;
            padding-left: 20px
        }

        .invoice-price {
            background: #f0f3f4;
            display: table;
            width: 100%
        }

        .invoice-price .invoice-price-left,
        .invoice-price .invoice-price-right {
            display: table-cell;
            padding: 20px;
            font-size: 20px;
            font-weight: 600;
            width: 75%;
            position: relative;
            vertical-align: middle
        }

        .invoice-price .invoice-price-left .sub-price {
            display: table-cell;
            vertical-align: middle;
            padding: 0 20px
        }

        .invoice-price small {
            font-size: 12px;
            font-weight: 400;
            display: block
        }

        .invoice-price .invoice-price-row {
            display: table;
            float: left
        }

        .invoice-price .invoice-price-right {
            width: 25%;
            background: #2d353c;
            color: #fff;
            font-size: 28px;
            text-align: right;
            vertical-align: bottom;
            font-weight: 300
        }

        .invoice-price .invoice-price-right small {
            display: block;
            opacity: .6;
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 12px
        }

        .invoice-footer {
            border-top: 1px solid #ddd;
            padding-top: 10px;
            font-size: 10px
        }

        .invoice-note {
            color: #999;
            margin-top: 40px;
            margin-bottom: 40px;
            font-size: 85%
        }

        .invoice > div:not(.invoice-footer) {
            margin-bottom: 0px
        }

        .btn.btn-white, .btn.btn-white.disabled, .btn.btn-white.disabled:focus, .btn.btn-white.disabled:hover, .btn.btn-white[disabled], .btn.btn-white[disabled]:focus, .btn.btn-white[disabled]:hover {
            color: #2d353c;
            background: #fff;
            border-color: #d9dfe3;
        }

        #watermark {
            position: absolute;
            right: 25%;
            top: 25%;
            opacity: 0.1;
            z-index: 99;
            color: white;
        }

        #title_page {
            color: white;
            background-color: #04AA6D;
            padding: 10px 0px;
            box-shadow: 5px 5px 7px -2px #9090927d;
        }
    </style>
</head>
<body>

<htmlpageheader name="firstpage">
    <table class="table" style="width: 100%">
        <thead>
        <tr>
            <td width="30%">
                <img src="{{setting('favicon')}}" style="height: 115px;">

                <div class="pull-right hidden-print" style="float: left">
                    <h5 class="caption-subject font-orange bold uppercase" style="color: #f5ae1a">
                        {{ setting('app_name','en') }}
                    </h5>
                </div>
            </td>
        </tr>
        </thead>
    </table>
</htmlpageheader>


<div style="padding-top: 120px">
    <table id="customers">
        <tr>

            <th>#</th>
            <th class="text-center">{{__('installment::dashboard.installmentpayments.datatable.instalment_id')}}</th>
            <th class="text-center">{{__('installment::dashboard.installments.datatable.paid_amount')}}</th>
            <th class="text-center">{{__('installment::dashboard.installments.datatable.transaction_date')}}</th>
            <th class="text-center">{{__('installment::dashboard.installmentpayments.datatable.payment_method')}}</th>
            <th class="text-center">{{__('installment::dashboard.installments.btn.paied_by')}}</th>
            <th class="text-center">{{__('installment::dashboard.installments.datatable.note')}}</th>
        </tr>
        
        @if(!empty($data))

            @foreach($data as $record)  
                <tr>
                    <td style="text-align: center">
                        {!! $record->id !!}
                    </td>
                    <td style="text-align: center">
                        {!! $record->installment_id !!}
                    </td>
                    <td style="text-align: center">
                        {!! $record->paid_amount !!}
                    </td>
                    <td style="text-align: center">
                        {!! $record->transaction_date !!}
                    </td>
                    <td style="text-align: center">
                        @if($record->pay_by_type != '')
                            {{__("installment::dashboard.installments.btn.{$record->pay_by_type}")}}
                        @endif
                    </td>
                    <td style="text-align: center">
                        @php 

                            if($record->pay_by_type == 'by_link'){

                                $clientName = ((array)json_decode($record->client_name));
                                $output = '';

                                if(isset($clientName['en'])){
                                    $output = "EN: {$clientName['en']}";
                                }

                                if(isset($clientName['ar'])){
                                    $output = "AR: {$clientName['ar']}";
                                }

                                $clientName = $output;

                            } elseif($record->pay_by_type == 'by_admin'){
                                $clientName = $record->admin_name;
                            }else{
                                $clientName = '';
                            }
                        @endphp
                        
                        {!! $clientName  !!}
                    </td>
                    <td style="text-align: center">
                        {!! $record->note !!}
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7" style="text-align: center">
                    {{__('apps::dashboard.datatable.no_data')}}
                </td>
            </tr>
        @endif
    </table>
</div>


<htmlpagefooter name="page-footer">

    {{\Carbon\Carbon::now()->format('y/m/d')}}
</htmlpagefooter>
</body>
</html>
