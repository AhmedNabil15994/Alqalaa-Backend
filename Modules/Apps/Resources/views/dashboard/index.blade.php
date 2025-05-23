@extends('apps::dashboard.layouts.app')
@section('title', __('apps::dashboard.index.title'))
@section('content')

    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{ url(route('dashboard.home')) }}">
                            {{ __('apps::dashboard.index.title') }}
                        </a>
                    </li>
                </ul>
            </div>
            <h1 class="page-title"> {{ __('apps::dashboard.index.welcome') }} ,
                <small><b style="color:red">{{ Auth::user()->name }} </b></small>
            </h1>

            @can('show_statistics')

                <div class="row">
                    <div class="col-lg-3">
                        {{-- DATATABLE FILTER --}}
                        <div class="row ">
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
                                                        <div class="col-md-12">
                                                            <div class="form-group  col-md-12">
                                                                <label class="control-label">
                                                                    {{__('apps::dashboard.datatable.form.date_score')}}
                                                                </label>
                                                                <div id="reportrange" class="btn default form-control">
                                                                    <i class="fa fa-calendar"></i> &nbsp;
                                                                    <span> </span>
                                                                    <b class="fa fa-angle-down"></b>
                                                                    <input type="hidden" name="from">
                                                                    <input type="hidden" name="to">
                                                                </div>
                                                            </div>

                                                            @include('user::dashboard.clients.components.select-search.index')
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <br>
                                            <div class="form-actions">
                                                <button class="btn btn-sm green btn-outline filter-submit margin-bottom"
                                                        id="filter_charts">
                                                    <i class="fa fa-search"></i>
                                                    {{__('apps::dashboard.datatable.search')}}
                                                </button>
                                                <button class="btn btn-sm red btn-outline" id="dashboard-filter-cancel">
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
                    </div>
                    <center>
                        <div id="processing">جارٍ التحميل...</div>
                    </center>
                    <div style="display: none" id="chart_content">
                        <div class="col-lg-9">
                            <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                                <a href="{{url(route('dashboard.contracts.index'))}}">
                                    <div class="dashboard-stat2 ">
                                        <div class="display">
                                            <div class="number">
                                                <h3 class="font-green-sharp">
                                                    <span id="total_contracts" data-counter="counterup"
                                                          data-value="0">0</span>
                                                    <small class="font-green-sharp" style="    font-size: 16px;">
                                                        {{__('contract::dashboard.contracts.datatable.total_contracts')}}
                                                    </small>
                                                </h3>
                                                <small>
                                                    {{__('contract::dashboard.contracts.datatable.contract')}}
                                                </small>
                                            </div>
                                            <div class="icon">
                                                <i class="icon-pie-chart"></i>
                                            </div>
                                        </div>
                                        <div class="progress-info">
                                            <div class="progress">
                                            <span style="width: 76%;"
                                                  class="progress-bar progress-bar-success green-sharp">
                                                <span class="sr-only"><span
                                                            class="total_contracts_percentage">0</span>%</span>
                                            </span>
                                            </div>
                                            <div class="status">
                                                <div class="status-title">
                                                    {{__('contract::dashboard.contracts.datatable.all_contracts_percentage')}}
                                                </div>
                                                <div class="status-number"><span
                                                            class="total_contracts_percentage">0</span>%
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                                <a href="{{url(route('dashboard.contracts.index').'?complete_status=completed')}}">
                                    <div class="dashboard-stat2 ">
                                        <div class="display">
                                            <div class="number">
                                                <h3 class="font-blue-sharp">
                                                    <span id="complete_contracts" data-counter="counterup"
                                                          data-value="0">0</span>
                                                    <small class="font-blue-sharp" style="    font-size: 16px;">
                                                        {{__('contract::dashboard.contracts.datatable.complete_contracts')}}
                                                    </small>
                                                </h3>
                                                <small>
                                                    {{__('contract::dashboard.contracts.datatable.contract')}}
                                                </small>
                                            </div>
                                            <div class="icon">
                                                <i class="icon-pie-chart"></i>
                                            </div>
                                        </div>
                                        <div class="progress-info">
                                            <div class="progress">
                                            <span style="width: 76%;"
                                                  class="progress-bar progress-bar-success blue-sharp">
                                                <span class="sr-only"><span
                                                            class="complete_contracts_percentage">0</span>%</span>
                                            </span>
                                            </div>
                                            <div class="status">
                                                <div class="status-title">
                                                    {{__('contract::dashboard.contracts.datatable.all_contracts_percentage')}}
                                                </div>
                                                <div class="status-number"><span
                                                            class="complete_contracts_percentage">0</span>%
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                                <a href="{{url(route('dashboard.contracts.index').'?complete_status=late')}}">
                                    <div class="dashboard-stat2 ">
                                        <div class="display">
                                            <div class="number">
                                                <h3 class="font-red-haze">
                                                    <span id="not_complete_contracts" data-counter="counterup"
                                                          data-value="0">0</span>
                                                    <small class="font-red-haze" style="    font-size: 16px;">
                                                        {{__('contract::dashboard.contracts.datatable.not_complete_contracts')}}
                                                    </small>
                                                </h3>
                                                <small>
                                                    {{__('contract::dashboard.contracts.datatable.contract')}}
                                                </small>
                                            </div>
                                            <div class="icon">
                                                <i class="icon-pie-chart"></i>
                                            </div>
                                        </div>
                                        <div class="progress-info">
                                            <div class="progress">
                                            <span style="width: 76%;"
                                                  class="progress-bar progress-bar-success red-haze">
                                                <span class="sr-only"><span
                                                            class="not_complete_contracts_percentage">0</span>%</span>
                                            </span>
                                            </div>
                                            <div class="status">
                                                <div class="status-title">
                                                    {{__('contract::dashboard.contracts.datatable.all_contracts_percentage')}}
                                                </div>
                                                <div class="status-number"><span
                                                            class="not_complete_contracts_percentage">0</span>%
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                                    <div class="visual">
                                        <i class="fa fa-money"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" class="widget-thumb-body-stat" data-value="0"
                                                  id="total_profit">0</span>
                                        </div>
                                        <div class="desc">  {{__('contract::dashboard.contracts.datatable.total_profit')}} </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                                    <div class="visual">
                                        <i class="fa fa-money"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" class="widget-thumb-body-stat" data-value="0"
                                                  id="total_price">0</span>
                                        </div>
                                        <div class="desc"> {{__('contract::dashboard.contracts.datatable.total_price')}} </div>
                                    </div>
                                </a>
                            </div>

                            <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                                <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                                    <div class="visual">
                                        <i class="fa fa-money"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" class="widget-thumb-body-stat" data-value="0"
                                                  id="total_paid">0</span></div>
                                        <div class="desc">  {{__('contract::dashboard.contracts.datatable.total_pays')}} </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        {{-- <div class="col-lg-12">

                            <!-- BEGIN ROW -->
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- BEGIN CHART PORTLET-->
                                    <div class="portlet light bordered">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="icon-bar-chart font-green-haze"></i>
                                                <span class="caption-subject bold uppercase font-green-haze"> {{__('contract::dashboard.contracts.datatable.contract_chart')}}</span>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div id="contract_chart" class="chart" style="height: 400px;"></div>
                                        </div>
                                    </div>
                                    <!-- END CHART PORTLET-->
                                </div>
                            </div>
                            <!-- END ROW -->

                        </div> --}}
                    </div>
                </div>



                @push('styles')
                    <style>
                        #processing {
                            width: 200px;
                            display: inline-block;
                            padding: 7px;
                            right: 50%;
                            margin-right: -100px;
                            margin-top: 10px;
                            text-align: center;
                            color: #3f444a;
                            border: 1px solid #e7ecf1;
                            background: #eef1f5;
                            vertical-align: middle;
                            box-shadow: 0 1px 8px rgb(0 0 0 / 10%);
                        }
                    </style>
                @endpush

                @push('scripts')
                <!-- BEGIN PAGE LEVEL PLUGINS -->
                    {{-- <script src="/admin/assets/global/plugins/amcharts/amcharts/amcharts.js"
                            type="text/javascript"></script>
                    <script src="/admin/assets/global/plugins/amcharts/amcharts/serial.js"
                            type="text/javascript"></script>
                    <script src="/admin/assets/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
                    <script src="/admin/assets/global/plugins/amcharts/amcharts/radar.js"
                            type="text/javascript"></script>
                    <script src="/admin/assets/global/plugins/amcharts/amcharts/themes/light.js"
                            type="text/javascript"></script>
                    <script src="/admin/assets/global/plugins/amcharts/amcharts/themes/patterns.js"
                            type="text/javascript"></script>
                    <script src="/admin/assets/global/plugins/amcharts/amcharts/themes/chalk.js"
                            type="text/javascript"></script>
                    <script src="/admin/assets/global/plugins/amcharts/ammap/ammap.js" type="text/javascript"></script>
                    <script src="/admin/assets/global/plugins/amcharts/ammap/maps/js/worldLow.js"
                            type="text/javascript"></script>
                    <script src="/admin/assets/global/plugins/amcharts/amstockcharts/amstock.js"
                            type="text/javascript"></script>
                    <!-- END PAGE LEVEL PLUGINS -->
                    <!-- BEGIN THEME GLOBAL SCRIPTS -->
                    <script src="/admin/assets/global/scripts/app.min.js" type="text/javascript"></script>
                    <!-- END THEME GLOBAL SCRIPTS -->
                    <!-- BEGIN PAGE LEVEL SCRIPTS -->
                    <script src="/admin/assets/pages/scripts/charts-amcharts.min.js" type="text/javascript"></script> --}}


                    <script>
                        // var ChartsAmcharts = function () {


                        //     var count_contract = function (data) {
                        //         var chart = AmCharts.makeChart("contract_chart", {
                        //             "type": "serial",
                        //             "theme": "light",

                        //             "fontFamily": 'Open Sans',
                        //             "color": '#888888',

                        //             "legend": {
                        //                 "equalWidths": false,
                        //                 "useGraphSettings": true,
                        //                 "valueAlign": "left",
                        //                 "valueWidth": 120
                        //             },
                        //             "dataProvider": data,
                        //             "graphs": [{
                        //                 "alphaField": "alpha",
                        //                 "balloonText": "[[value]] {{__('apps::dashboard.chart.contract')}}",
                        //                 "dashLengthField": "dashLength",
                        //                 "fillAlphas": 0.7,
                        //                 "legendPeriodValueText": "[[value.sum]]",
                        //                 "legendValueText": "[[value]]",
                        //                 "title": "{{__('apps::dashboard.chart.total_contracts')}}",
                        //                 "type": "column",
                        //                 "valueField": "contract_counts",
                        //                 "valueAxis": "countAxis"
                        //             }, {
                        //                 "balloonText": "[[value]] KWD",
                        //                 "bullet": "round",
                        //                 "bulletBorderAlpha": 1,
                        //                 "useLineColorForBulletBorder": true,
                        //                 "bulletColor": "#FFFFFF",
                        //                 "labelPosition": "right",
                        //                 "legendPeriodValueText": " [[value.sum]] KWD",
                        //                 "legendValueText": "[[value]] KWD",
                        //                 "title": "{{__('apps::dashboard.chart.total_prices')}}",
                        //                 "fillAlphas": 0,
                        //                 "valueField": "total_prices",
                        //                 "valueAxis": "totalPricesAxis"
                        //             }, {
                        //                 "bullet": "square",
                        //                 "bulletBorderAlpha": 1,
                        //                 "bulletBorderThickness": 1,
                        //                 "dashLengthField": "dashLength",
                        //                 "legendPeriodValueText": " [[value.sum]] KWD",
                        //                 "legendValueText": "[[value]] KWD",
                        //                 "title": "{{__('apps::dashboard.chart.total_paid')}}",
                        //                 "fillAlphas": 0,
                        //                 "valueField": "total_paid",
                        //                 "valueAxis": "totalPaidAxis"
                        //             }],
                        //             "chartScrollbar": {},
                        //             "chartCursor": {
                        //                 "categoryBalloonDateFormat": "DD",
                        //                 "cursorAlpha": 0.1,
                        //                 "cursorColor": "#000000",
                        //                 "fullWidth": true,
                        //                 "valueBalloonsEnabled": false,
                        //                 "zoomable": false
                        //             },
                        //             "dataDateFormat": "YYYY-MM-DD",
                        //             "categoryField": "date",
                        //             "categoryAxis": {
                        //                 "dateFormats": [{
                        //                     "period": "DD",
                        //                     "format": "DD"
                        //                 }, {
                        //                     "period": "WW",
                        //                     "format": "MMM DD"
                        //                 }, {
                        //                     "period": "MM",
                        //                     "format": "MMM"
                        //                 }, {
                        //                     "period": "YYYY",
                        //                     "format": "YYYY"
                        //                 }],
                        //                 "parseDates": true,
                        //                 "autoGridCount": false,
                        //                 "axisColor": "#555555",
                        //                 "gridAlpha": 0.1,
                        //                 "gridColor": "#FFFFFF",
                        //                 "gridCount": 50
                        //             },
                        //             "exportConfig": {
                        //                 "menuBottom": "20px",
                        //                 "menuRight": "22px",
                        //                 "menuItems": [{
                        //                     "icon": App.getGlobalPluginsPath() + "amcharts/amcharts/images/export.png",
                        //                     "format": 'png'
                        //                 }]
                        //             }
                        //         });

                        //         $('#chart_2').closest('.portlet').find('.fullscreen').click(function () {
                        //             chart.invalidateSize();
                        //         });
                        //     };

                        //     return {
                        //         init: function (data) {
                        //             count_contract(data);
                        //         }
                        //     };
                        // }();

                        jQuery(document).ready(function () {
                            var data = $("#formFilter").serialize();
                            loadCharts(data);
                        });


                        $('#filter_charts').click(function () {

                            var data = $("#formFilter").serialize();
                            loadCharts(data);
                        });

                        $('#dashboard-filter-cancel').click(function () {

                            document.getElementById("formFilter").reset();

                            $('.select2').val(null).trigger('change');

                            loadCharts();
                        });

                        function loadCharts(data = '') {
                            $('#chart_content').hide();
                            $('#processing').show();

                            $.ajax({
                                url: '{{url(route('dashboard.chart'))}}',
                                type: 'get',
                                data: data,
                                contentType: false,
                                cache: false,
                                processData: false,
                                success: function (data) {
                                    totalCountBuilder(data);
                                    percentageBuilder(data);
                                    // ChartsAmcharts.init(data.chart);
                                    $('#processing').hide();
                                    $('#chart_content').show();
                                },
                            });
                        }

                        function percentageBuilder(data) {
                            $('#total_contracts').text('').append(data.contract_count).attr('data-value', data.contract_count);
                            $('.total_contracts_percentage').text('').append(100);
                            $('#complete_contracts').text('').append(data.completed_contract_count.count).attr('data-value', data.completed_contract_count.count);
                            $('.complete_contracts_percentage').text('').append(data.completed_contract_count.percentage);
                            $('#not_complete_contracts').text('').append(data.late_contract_count.count).attr('data-value', data.late_contract_count.count);
                            $('.not_complete_contracts_percentage').text('').append(data.late_contract_count.percentage);
                            $('.widget-thumb-body-stat,#total_contracts,#complete_contracts,#not_complete_contracts').counterUp({
                                delay: 5,
                                time: 1000
                            });
                        }

                        function totalCountBuilder(data) {
                            $('#total_paid').text('').append(data.total_paid).attr('data-value', data.total_paid);
                            $('#total_profit').text('').append(data.total_profit).attr('data-value', data.total_profit);
                            $('#total_price').text('').append(data.total_price).attr('data-value', data.total_price);
                        }


                        $(document).ready(function () {
                            var start = moment().startOf('month');
                            var end = moment().endOf('month');

                            function cb(start, end) {

                                if ((isNaN(start) && isNaN(end)) || (start == null && end == null)) {

                                    $('#reportrange span').html('{{__('apps::dashboard.buttons.datapicker.all')}}');
                                    $('input[name="from"]').val('');
                                    $('input[name="to"]').val('');

                                } else if (start.isValid() && end.isValid()) {

                                    $('#reportrange span').html(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
                                    $('input[name="from"]').val(start.format('YYYY-MM-DD'));
                                    $('input[name="to"]').val(end.format('YYYY-MM-DD'));
                                }
                            }

                            $('#reportrange').daterangepicker({
                                startDate: start,
                                endDate: end,
                                ranges: {
                                    '{{__('apps::dashboard.buttons.datapicker.daily')}}': [moment(), moment()],
                                    '{{__('apps::dashboard.buttons.datapicker.monthly')}}': [moment().startOf('month'), moment().endOf('month')],
                                    '{{__('apps::dashboard.buttons.datapicker.yearly')}}': [moment().startOf('year'), moment().endOf('year')],
                                    '{{__('apps::dashboard.buttons.datapicker.yesterday')}}': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                                    '{{__('apps::dashboard.buttons.datapicker.7days')}}': [moment().subtract(6, 'days'), moment()],
                                    '{{__('apps::dashboard.buttons.datapicker.30days')}}': [moment().subtract(29, 'days'), moment()],
                                    '{{__('apps::dashboard.buttons.datapicker.last_month')}}': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                                    '{{__('apps::dashboard.buttons.datapicker.last_year')}}': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
                                },
                                @if (is_rtl() == 'rtl')
                                opens: 'left',
                                @endif
                                buttonClasses: ['btn'],
                                applyClass: 'btn-primary',
                                cancelClass: 'btn-danger',
                                format: 'YYYY-MM-DD',
                                separator: 'to',
                                locale: {
                                    applyLabel: '{{__('apps::dashboard.buttons.save')}}',
                                    cancelLabel: '{{__('apps::dashboard.buttons.cancel')}}',
                                    fromLabel: '{{__('apps::dashboard.buttons.from')}}',
                                    toLabel: '{{__('apps::dashboard.buttons.to')}}',
                                    customRangeLabel: '{{__('apps::dashboard.buttons.custom')}}',
                                    firstDay: 1
                                }
                            }, cb);

                            cb(start,end);

                        });
                    </script>
                @endpush
            @endcan
        </div>
    </div>

@stop
