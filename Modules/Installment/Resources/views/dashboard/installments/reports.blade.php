@extends('apps::dashboard.layouts.app')
@section('title', __('installment::dashboard.installments.routes.index'))

@section('css')
    <style>
        .tooltip {
            position: relative;
            display: inline-block;
        }

        .tooltip2 .tooltiptext {
            visibility: hidden;
            width: 140px;
            background-color: #555;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 2px 6px;
            position: sticky;
            z-index: 8;
            bottom: 150%;
            left: 50%;
            margin-left: -75px;
            opacity: 50 !important;
            transition: opacity 0.3s;
        }

        .tooltip2 .tooltiptext::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #555 transparent transparent transparent;
        }

        .tooltip2:hover .tooltiptext {
            visibility: visible;
            opacity: 50;
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
                        <a href="#">{{__('installment::dashboard.installments.routes.index')}}</a>
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
                                                            {!! field('dashboard_login')->select('contract_id',__('installment::dashboard.installments.filters.contract_id'),[])!!}
                                                            @push('scripts')
                                                                <script>
                                                                    $('#client_id').change(function () {
                                                                        var url = '{!! url(route('dashboard.contracts.get-with-client-id',':client')) !!}';
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
                                                                            error: function (data) {

                                                                                $('#contract_id').text('').append('<option value="" selected>لا يوجد مدن تابعة لهذه المحافظة</option>');
                                                                            }
                                                                        });
                                                                    });
                                                                </script>
                                                            @endpush
                                                            <br>
                                                        </div>

                                                        <div class="clearfix"></div>
                                                        <div class="col-md-6">

                                                            <label class="control-label">
                                                                {{__('installment::dashboard.installments.filters.status')}}
                                                            </label>

                                                            <div class="form-group">

                                                                <label class="control-label"
                                                                       style="    margin-right: 9px;">
                                                                    {{__('installment::dashboard.installments.datatable.waiting')}}
                                                                </label>
                                                                <input type="checkbox" name="status[]" value="waiting">

                                                                <label class="control-label"
                                                                       style="    margin-right: 9px;">
                                                                    {{__('installment::dashboard.installments.datatable.not_complete')}}
                                                                </label>
                                                                <input type="checkbox" name="status[]"
                                                                       value="not_complete">

                                                                <label class="control-label"
                                                                       style="    margin-right: 9px;">
                                                                    {{__('installment::dashboard.installments.datatable.completed')}}
                                                                </label>
                                                                <input type="checkbox" name="status[]"
                                                                       value="completed">
                                                                <br>
                                                            </div>
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
                                {{__('installment::dashboard.installments.routes.index')}}
                            </span>
                            </div>
{{--                            <div style="float: left">--}}
{{--                                <div class="dt-buttons">--}}
{{--                                    <a class="dt-button buttons-print btn blue btn-outline" tabindex="0" aria-controls="dataTable" href="#" onclick="runTable('print')">--}}
{{--                                        <span>{{__('apps::dashboard.datatable.print')}}</span>--}}
{{--                                    </a>--}}
{{--                                    <a class="dt-button buttons-pdf buttons-html5 btn blue btn-outline" tabindex="0" aria-controls="dataTable" href="#" onclick="runTable('pdf')">--}}
{{--                                        <span>{{__('apps::dashboard.datatable.pdf')}}</span>--}}
{{--                                    </a>--}}
{{--                                    <a class="dt-button buttons-excel buttons-html5 btn blue btn-outline" tabindex="0" aria-controls="dataTable" href="#">--}}
{{--                                        <span>{{__('apps::dashboard.datatable.excel')}}</span>--}}
{{--                                    </a>--}}
{{--                                    <a class="dt-button buttons-collection buttons-colvis btn blue btn-outline" tabindex="0" aria-controls="dataTable" href="#">--}}
{{--                                        <span>{{__('apps::dashboard.datatable.colvis')}}</span>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>

                        {{-- DATATABLE CONTENT --}}
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover" id="dataTable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="text-center">{{__('installment::dashboard.installments.datatable.contract_id')}}</th>
                                    <th class="text-center">{{__('installment::dashboard.installments.datatable.client')}}</th>
                                    <th class="text-center">{{__('installment::dashboard.installments.datatable.asked_amount')}}</th>
                                    <th class="text-center">{{__('installment::dashboard.installments.datatable.paid_amount')}}</th>
                                    <th class="text-center">{{__('installment::dashboard.installments.datatable.remaining_amount')}}</th>
                                    <th class="text-center">{{__('installment::dashboard.installments.datatable.due_date')}}</th>
                                    <th class="text-center">{{__('installment::dashboard.installments.datatable.transaction_date')}}</th>
                                    <th class="text-center">{{__('installment::dashboard.installments.datatable.status')}}</th>
                                    <th class="text-center">{{__('installment::dashboard.installments.datatable.details')}}</th>
                                    <th class="text-center">{{__('installment::dashboard.installments.datatable.pay')}} </th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <button type="submit" id="PayChecked" class="btn btn-primary btn-sm"
                                        onclick="PayAllChecked('{{ url(route('dashboard.installments.multi.pay')) }}')">
                                    {{__('installment::dashboard.installments.datatable.multi_pay')}}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="copyUrlModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row">
                    <div class="col-lg-9">

                        {!! field('dashboard_login')
                        ->text('payment_url' ,
                        __('installment::dashboard.installments.datatable.payment_url'),
                        null,['readonly','readonly']) !!}
                    </div>
                    <div class="col-lg-3">

                        <div class="tooltip2">
                            <span class="tooltiptext"
                                  id="myTooltip">{{__('installment::dashboard.installments.datatable.copy_to_clipboard')}}</span>
                            <br>
                            <button onclick="copyUrl()" onmouseout="outFunc()" class="btn btn-xs btn-success"
                                    style="    margin: 10px 21px;">
                                <i class="fa fa-copy"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg"
         id="pay-installment"
         tabindex="-1"
         role="dialog"
         aria-labelledby="myLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <h4 class="modal-title">
                        {{__('installment::dashboard.installments.btn.pay_installment')}}
                    </h4>
                </div>
                <div class="modal-body">
                    {!! Form::open([
                        'url' => url(route('dashboard.installments.update','::id')),
                        'id'=>'instalment-form',
                        'method' => 'put',
                    ]) !!}

                    {!! field()->number('contract_modal_id' ,__('installment::dashboard.installments.datatable.contract_id'), null , ['readonly' => 'readonly']) !!}
                    {!! field()->number('amount' ,__('installment::dashboard.installments.datatable.total_amount') , '::amount' , ['readonly' => 'readonly']) !!}
                    {!! field()->number('paid' ,__('installment::dashboard.installments.datatable.paid_amount') , '::paid' , ['readonly' => 'readonly']) !!}
                    {!! field()->number('remaining' ,__('installment::dashboard.installments.datatable.remaining_amount') , '::remaining' , ['readonly' => 'readonly']) !!}
                    {!! field()->number('pay_now' ,__('installment::dashboard.installments.datatable.paid_amount') , '::remaining',['step'=> '0.001']) !!}
                    {!! field()->date('transaction_date' ,__('installment::dashboard.installments.datatable.transaction_date')) !!}
                    {!! field()->textarea('note',__('installment::dashboard.installments.datatable.note'),null,['class' => 'form-control']) !!}
                </div>
                <div class="modal-footer">
                    <div class="clearfix"></div>
                    <br>
                    <button type="button"
                            class="btn btn-white"
                            data-dismiss="modal">
                        {{__('installment::dashboard.installments.btn.cancel')}}
                    </button>
                    {!! Form::submit('حفظ',[
                        'class' => 'btn btn-primary'
                        ]) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>

        function outFunc() {
            var tooltip = document.getElementById("myTooltip");
            tooltip.innerHTML = "{{__('installment::dashboard.installments.datatable.copy_to_clipboard')}}";
        }

        function copyUrl() {
            /* Get the text field */
            var copyUrl = document.getElementById("payment_url");

            /* Select the text field */
            copyUrl.select();
            copyUrl.setSelectionRange(0, 99999); /* For mobile devices */

            /* Copy the text inside the text field */
            navigator.clipboard.writeText(copyUrl.value);

            var tooltip = document.getElementById("myTooltip");
            tooltip.innerHTML = "{{__('installment::dashboard.installments.datatable.copied_the_text')}}";
        }

        function openPayModel(id, contract_id, amount, paid, remaining) {

            resetErrors();
            var $form = $('#instalment-form');
            var url = '{{ route('dashboard.installments.update',':id') }}';
            url = url.replace(':id', id);
            $form.attr('action', url);
            $('#amount').val(amount);
            $('#paid').val(paid);
            $('#remaining').val(remaining);
            $('#pay_now').val(remaining);
            $('#contract_modal_id').val(contract_id);
            $("#pay-installment").modal('show');
        }

        function cancelPay(url) {
            $(".modal").modal('hide');
            swal({
                title: "{{__('installment::dashboard.installments.titles.are_you_sure_cancel_pay')}}",
                icon: "warning",
                buttons: {
                    cancel: {
                        text: '{{__('installment::dashboard.installments.btn.cancel')}}',
                        value: false,
                        visible: true,
                        className: "",
                        closeModal: true,
                    },
                    confirm: {
                        text: '{{__('installment::dashboard.installments.btn.confirm')}}',
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
                        type: 'get',
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

            $(".modal").modal('hide');
            $('#dataTable').DataTable().destroy();
            tableGenerate();
        }

        $('#instalment-form').on('submit', function (e) {
            e.preventDefault();

            tinyMCE.triggerSave();

            var url = $(this).attr('action');
            var method = $(this).attr('method');

            $.ajax({

                xhr: function () {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function (evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            percentComplete = parseInt(percentComplete * 100);
                            $('.progress-bar').width(percentComplete + '%');
                            $('#progress-status').html(percentComplete + '%');
                        }
                    }, false);
                    return xhr;
                },

                url: url,
                type: method,
                dataType: 'JSON',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,

                beforeSend: function () {
                    $('#submit').prop('disabled', true);
                    $('.progress-info').show();
                    $('.progress-bar').width('0%');
                    resetErrors();
                },
                success: function (data) {

                    $('#submit').prop('disabled', false);
                    $('#submit').text();

                    if (data[0] == true) {
                        refreshInstalmentTable();
                        successfully(data);
                        resetErrors();
                        redirect(data);
              
                   
                        } else {
                        displayMissing(data);
                    }
                },
                error: function (data) {

                    $('#submit').prop('disabled', false);
                    displayErrors(data);

                },
            });

        });


        // DELETE ROW FROM DATATABLE
        function PayAllChecked(url) {
            var someObj = [];

            $('#PayChecked').prop('disabled', true);
            $("input:checkbox").each(function () {
                var $this = $(this);

                if ($this.is(":checked")) {
                    someObj.push($this.attr("value"));
                }
            });

            $.ajax({
                url: url,
                data: {ides: someObj},
                type: "get",
                success: function (data) {

                    if (data[0] == true) {
                        $('#payment_url').val(data.payment);
                        $('#copyUrlModal').modal('show');
                    } else {
                        displayMissing(data);
                    }
                    $('#PayChecked').prop('disabled', false);

                },
            });
        }
    </script>
    @include('installment::dashboard.installments.components.table')
@stop