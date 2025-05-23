<!DOCTYPE html>
<html lang="{{ locale() }}" dir="{{ is_rtl() }}" id="html_content">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>{{ setting('app_name',locale()) }}</title>
    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet" type="text/css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/css/bootstrap.min.css" rel="stylesheet">

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
    </style>
    <style>
        body {
            font-family: 'Cairo', sans-serif !important;
            border: double;
            font-size: 20px;
            font-weight: 500;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="col-md-12">
        <div class="invoice">
            <!-- begin invoice-company -->
            <div class="invoice-company text-inverse f-w-600">

                <div style="text-align: center;">
                    <span class="pull-right hidden-print" style="    margin-top: 49px;">
                        <h5 class="caption-subject font-orange bold uppercase" style="color: #f5ae1a">
                            {{ setting('app_name','ar') }}
                        </h5>
                    </span>
                    <img src="{{ setting('favicon') ? url(setting('favicon')) : '' }}" style="height: 115px;">

                    <span class="pull-left hidden-print" style="    margin-top: 49px;">
                        <h6 class="caption-subject font-orange bold uppercase" style="color: #f5ae1a">
                        {{ setting('app_name','en') }}
                        </h6>
                    </span>
                </div>
            </div>

            @yield('content')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
