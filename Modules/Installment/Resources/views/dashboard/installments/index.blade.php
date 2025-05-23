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
                                                                <div id="installment_range"
                                                                     class="btn default form-control">
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
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    {{__('installment::dashboard.installments.datatable.payment_date')}}
                                                                </label>
                                                                <div id="transaction_date_range"
                                                                     class="btn default form-control">
                                                                    <i class="fa fa-calendar"></i> &nbsp;
                                                                    <span> </span>
                                                                    <b class="fa fa-angle-down"></b>
                                                                    <input type="hidden" name="transaction_date_from">
                                                                    <input type="hidden" name="transaction_date_to">
                                                                </div>
                                                            </div>
                                                            <br>
                                                        </div>
                                                        <div class="col-md-3">
                                                            @include('user::dashboard.clients.components.select-search.index')
                                                        </div>
                                                        @can("filter_installment_with_paid_employee")
                                                            <div class="col-md-3">
                                                                @inject('users','Modules\User\Entities\User')
                                                                {!! field('dashboard_login')->select('paid_by',__('installment::dashboard.installments.filters.paid_by'),
                                                                $users->pluck('name','id')->toArray())!!}
                                                            </div>
                                                        @endcan
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
                                                                                    var option = '<option value="' + item.id + '">' + item.contract_number + '</option>';
                                                                                    builtSelectCategory += option;
                                                                                });

                                                                                $('#contract_id').text('').append(builtSelectCategory);
                                                                            },
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
                        </div>

                        {{-- DATATABLE CONTENT --}}
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover" id="dataTable">
                                <thead>
                                <tr>
                                    <th>
                                        <a href="javascript:;" onclick="CheckAll()">
                                            {{__('apps::dashboard.buttons.select_all')}}
                                        </a>
                                    </th>
                                    <th>{{__('installment::dashboard.installments.datatable.edit_remaining_amount')}}</th>
                                    <th>#</th>
                                    <th class="text-center">{{__('installment::dashboard.installments.datatable.client')}}</th>
                                    <th class="text-center">{{__('installment::dashboard.installments.datatable.contract_id')}}</th>
                                    <th class="text-center">{{__('installment::dashboard.installments.datatable.asked_amount')}}</th>
                                    <th class="text-center">{{__('installment::dashboard.installments.datatable.paid_amount')}}</th>
                                    <th class="text-center">{{__('installment::dashboard.installments.datatable.remaining_amount')}}</th>
                                    <th class="text-center">{{__('installment::dashboard.installments.datatable.due_date')}}</th>
                                    <th class="text-center">{{__('installment::dashboard.installments.datatable.transaction_date')}}</th>
                                    <th class="text-center">{{__('installment::dashboard.installments.datatable.offer')}}</th>
                                    <th class="text-center">{{__('installment::dashboard.installments.datatable.status')}}</th>
                                    <th class="text-center">{{__('installment::dashboard.installments.datatable.details')}}</th>

                                    @if(auth()->user()->can('pay_installments') || auth()->user()->can('can_cancel_installments_pay'))
                                        <th class="text-center">{{__('installment::dashboard.installments.datatable.pay')}} </th>
                                    @endif
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                @can('send_multi_installments')
                                <button type="submit" class="btn yellow btn-sm"
                                        onclick="messageAllChecked('{{ route('dashboard.installments.multi.send-whatsapp') }}')">
                                    {{__('installment::dashboard.installments.btn.send_whatsapp')}}
                                </button>
                                @endcan
                                @can('pay_installments')
                                    <button type="submit" class="btn btn-warning btn-sm"
                                            onclick="PayAllChecked('open_model')">
                                        {{__('installment::dashboard.installments.datatable.pay_all_check')}}
                                    </button>
                                @endcan
                                <button type="submit" id="PayChecked" class="btn btn-primary btn-sm"
                                        onclick="generatePaymentUrl('{{ route('dashboard.installments.multi.pay') }}')">
                                    {{__('installment::dashboard.installments.datatable.multi_pay')}}
                                </button>

                                @can('add_offer_installment')
                                    <button type="button" class="btn btn-success btn-sm"
                                            onclick="offerAllChecked()">
                                        {{__('installment::dashboard.installments.datatable.add_offer')}}
                                    </button>
                                @endcan

                                @can('cancel_offer_installment')
                                <button type="submit" class="btn red btn-sm"
                                        onclick="cancelAllOffer('{{ route('dashboard.installments.multi.cancel-offer') }}')">
                                    {{__('installment::dashboard.installments.datatable.cancel_offers')}}
                                </button>
                                @endcan
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

    @can('add_offer_installment')
    <!-- Modal -->
    <div class="modal fade" id="addOfferModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                    <div class="col-lg-12">
                        {!! field()->number('offer_percentage' , __('installment::dashboard.installments.datatable.offer'),null,['max' => '100']) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="addOffer" class="btn btn-success btn-sm"
                            onclick="offerAllChecked('{{ route('dashboard.installments.multi.add-offer') }}')">
                        {{__('installment::dashboard.installments.datatable.add_offer')}}
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endcan

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

                    <input type="hidden" name="contract_modal_id" id="contract_modal_id">
                    {!! field()->number('contract_modal_number' ,__('installment::dashboard.installments.datatable.contract_id'), null , ['readonly' => 'readonly']) !!}
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


    @can('pay_installments')
    <div class="modal fade bd-example-modal-lg"
         id="pay-employee-installment"
         tabindex="-1"
         role="dialog"
         aria-labelledby="pay-employee-installment"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <h4 class="modal-title">
                        {{__('installment::dashboard.installments.btn.pay_installment')}}
                    </h4>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="contract_modal_id" id="contract_modal_id">
                    {!! field()->date('employee_payment_transaction_date' ,__('installment::dashboard.installments.datatable.transaction_date')) !!}
                    {!! field()->textarea('employee_payment_note',__('installment::dashboard.installments.datatable.note'),null,['class' => 'form-control']) !!}
                </div>
                <div class="modal-footer">
                    <div class="clearfix"></div>
                    <br>
                    <button type="submit" id="payMultiple" class="btn btn-primary btn-sm"
                            onclick="PayAllChecked('submit_request')">
                        {{__('installment::dashboard.installments.datatable.pay_all_check')}}
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endcan
@stop

@section('scripts')
    <script>
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
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

        function openPayModel(id, contract_id, amount, paid, remaining,contract_number) {

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
            $('#contract_modal_number').val(contract_number);
            $("#pay-installment").modal('show');
        }

        function sendWhatsapp(id, contract_id, amount, paid, remaining,contract_number) {
            $.ajax({
                url: "{{route('dashboard.installments.send_WAMsg',['id'=>':id'])}}".replace(':id',id),
                type: "get",
                success: function (data) {
                    if(data[0]){
                        successfully(data);
                    }
                },
            });
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
        function generatePaymentUrl(url) {
            var someObj = [];
            var $first = [];
            var $remainings = [];

            $('#PayChecked').prop('disabled', true);
            $("input.ids:checkbox").each(function () {
                var $this = $(this);

                if ($this.is(":checked")) {
                    dataTable.rows().every(function () {
                        $first = ($(dataTable.cell(this.index(), 1).node()).find('#remaining_'+$this.attr("target")).val());
                        if ($first)
                            $remainings.push($first);
                    });
                    someObj.push($this.attr("value"));
                }
            });

            $.ajax({
                url: url,
                data: {ides: someObj,remaining : $remainings},
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


        @can('pay_installments')
        // DELETE ROW FROM DATATABLE
        function PayAllChecked(type = 'submit_request') {

            var someObj = [];
            var $first = [];
            var $remainings = [];

            $("input.ids:checkbox").each(function () {
                var $this = $(this);

                if ($this.is(":checked")) {
                    dataTable.rows().every(function () {
                        $first = ($(dataTable.cell(this.index(), 1).node()).find('#remaining_'+$this.attr("target")).val());
                        if ($first)
                            $remainings.push($first);
                    });
                    someObj.push($this.attr("value"));
                }
            });

            if(someObj.length > 0){
                if(type == 'open_model'){

                    $('#pay-employee-installment').modal('show');

                }else if(type == 'submit_request'){

                    let transactionDate = $("#employee_payment_transaction_date").val(),
                        paymentNote = $("#employee_payment_note").val();

                        if(transactionDate){

                            // $('#payMultiple').prop('disabled', true);
                            $.ajax({
                                url: '{{route('dashboard.installments.multi.employee.pay')}}',
                                data: {ides: someObj,remaining : $remainings,transaction_date : transactionDate, payment_note : paymentNote},
                                type: "get",
                                success: function (data) {

                                    if (data[0] == true) {
                                        $('#pay-employee-installment').modal('hide');
                                        successfully(data);
                                        refreshInstalmentTable();
                                    } else {
                                        displayMissing(data);
                                    }


                                    $('#payMultiple').prop('disabled', false);
                                },
                            });
                        }else{

                            toastr["error"]('@lang("Transaction date is required")');
                        }
                }
            }else{
                toastr["error"]('@lang("Please select installments first")');
            }
        }

        function messageAllChecked(url) {

            var someObj = [];
            var $first = [];
            var $remainings = [];

            $("input.ids:checkbox").each(function () {
                var $this = $(this);

                if ($this.is(":checked")) {
                    dataTable.rows().every(function () {
                        $first = ($(dataTable.cell(this.index(), 1).node()).find('#remaining_'+$this.attr("target")).val());
                        if ($first)
                            $remainings.push($first);
                    });
                    someObj.push($this.attr("value"));
                }
            });

            if(someObj.length > 0){
                $.ajax({
                    url: url,
                    data: {ids: someObj},
                    type: "get",
                    success: function (data) {
                        if(data[0]){
                            successfully(data);
                        }
                    },
                });
            }else{
                toastr["error"]('@lang("Please select installments first")');
            }
        }
        @endcan

        // DELETE ROW FROM DATATABLE
        function offerAllChecked(url = null) {

            var someObj = [];
            var $first = [];
            var $remainings = [];

            $("input.ids:checkbox").each(function () {
                var $this = $(this);

                if ($this.is(":checked")) {
                    dataTable.rows().every(function () {
                        $first = ($(dataTable.cell(this.index(), 1).node()).find('#remaining_'+$this.attr("target")).val());
                        if ($first)
                            $remainings.push($first);
                    });
                    someObj.push($this.attr("value"));
                }
            });

            if(someObj.length){
                if(url){
                    let offer_percentage = $('#offer_percentage');
                    $('#addOffer').prop('disabled', true);

                    if(offer_percentage.val().length !== 0 || offer_percentage.val() != ''){

                    $.ajax({
                        url: url,
                        data: {ides: someObj,offer_percentage:offer_percentage.val()},
                        type: "get",
                        success: function (data) {

                            if (data[0] == true) {

                                toastr["success"]('{{ __('installment::dashboard.installments.datatable.offer_added_successfully') }}');
                                $('#addOfferModal').modal('hide');
                                refreshInstalmentTable();
                            } else {
                                displayMissing(data);
                            }

                            $('#addOffer').prop('disabled', false);
                        },
                    });
                    }else{
                        toastr["error"]('{{ __('installment::dashboard.installments.datatable.enter_offer_percentage') }}');
                        offer_percentage.focus();
                        $('#addOffer').prop('disabled', false);
                    }

                }else{

                    $('#addOfferModal').modal('show');
                }
            }else{

                toastr["error"]('{{ __('installment::dashboard.installments.datatable.select_installment') }}');
            }
        }

        // DELETE ROW FROM DATATABLE
        function cancelAllOffer(url)
        {
            var someObj = [];
            var $first = [];
            var $remainings = [];

            $("input.ids:checkbox").each(function () {
                var $this = $(this);

                if ($this.is(":checked")) {
                    dataTable.rows().every(function () {
                        $first = ($(dataTable.cell(this.index(), 1).node()).find('#remaining_'+$this.attr("target")).val());
                        if ($first)
                            $remainings.push($first);
                    });
                    someObj.push($this.attr("value"));
                }
            });

            if(someObj.length){

                bootbox.confirm({
                    message: '{{__('installment::dashboard.installments.titles.cancel_all_offer')}}',
                    buttons: {
                        confirm: {
                            label: '{{__('apps::dashboard.buttons.yes')}}',
                            className: 'btn-success'
                        },
                        cancel: {
                            label: '{{__('apps::dashboard.buttons.no')}}',
                            className: 'btn-danger'
                        }
                    },

                    callback: function (result) {
                        if(result){

                            $.ajax({
                                type    : "GET",
                                url     : url,
                                data    : {
                                        ides     : someObj,
                                    },
                                success: function(msg) {

                                    if (msg[0] == true){
                                        toastr["success"](msg[1]);
                                        refreshInstalmentTable();
                                    }
                                    else{
                                        toastr["error"](msg[1]);
                                    }

                                },
                                error: function( msg ) {
                                    toastr["error"](msg[1]);
                                }
                            });

                        }
                    }
                });

            }else{

                toastr["error"]('{{ __('installment::dashboard.installments.datatable.select_installment') }}');
            }

        }

        $(document).ready(function () {

            var start = moment().subtract(29, 'days');
            var end = moment();


            function cb(start_date, end) {

                if ((isNaN(start_date) && isNaN(end)) || (start_date == null && end == null)) {

                    $('#installment_range span').html('{{__('apps::dashboard.buttons.datapicker.all')}}');
                    $('input[name="from"]').val('all');
                    $('input[name="to"]').val('');

                } else if (start_date.isValid() && end.isValid()) {

                    $('#installment_range span').html(start_date.format('YYYY/MM/DD') + ' - ' + end.format('YYYY/MM/DD'));
                    $('input[name="from"]').val(start_date.format('YYYY-MM-DD'));
                    $('input[name="to"]').val(end.format('YYYY-MM-DD'));
                }
            }

            $('#installment_range').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    '{{__('apps::dashboard.buttons.datapicker.all')}}': [NaN, NaN],
                    '{{__('apps::dashboard.buttons.datapicker.today')}}': [moment(), moment()],
                    '{{__('apps::dashboard.buttons.datapicker.yesterday')}}': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    '{{__('apps::dashboard.buttons.datapicker.7days')}}': [moment().subtract(6, 'days'), moment()],
                    '{{__('apps::dashboard.buttons.datapicker.30days')}}': [moment().subtract(29, 'days'), moment()],
                    '{{__('apps::dashboard.buttons.datapicker.month')}}': [moment().startOf('month'), moment().endOf('month')],
                    '{{__('apps::dashboard.buttons.datapicker.last_month')}}': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
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

            cb(NaN, NaN);

        });

        $(document).ready(function () {

            var start = moment().subtract(29, 'days');
            var end = moment();


            function cb(start_date, end) {

                if ((isNaN(start_date) && isNaN(end)) || (start_date == null && end == null)) {

                    $('#transaction_date_range span').html('{{__('apps::dashboard.buttons.datapicker.all')}}');
                    $('input[name="transaction_date_from"]').val('all');
                    $('input[name="transaction_date_to"]').val('');

                } else if (start_date.isValid() && end.isValid()) {

                    $('#transaction_date_range span').html(start_date.format('YYYY/MM/DD') + ' - ' + end.format('YYYY/MM/DD'));
                    $('input[name="transaction_date_from"]').val(start_date.format('YYYY-MM-DD'));
                    $('input[name="transaction_date_to"]').val(end.format('YYYY-MM-DD'));
                }
            }

            $('#transaction_date_range').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    '{{__('apps::dashboard.buttons.datapicker.all')}}': [NaN, NaN],
                    '{{__('apps::dashboard.buttons.datapicker.today')}}': [moment(), moment()],
                    '{{__('apps::dashboard.buttons.datapicker.yesterday')}}': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    '{{__('apps::dashboard.buttons.datapicker.7days')}}': [moment().subtract(6, 'days'), moment()],
                    '{{__('apps::dashboard.buttons.datapicker.30days')}}': [moment().subtract(29, 'days'), moment()],
                    '{{__('apps::dashboard.buttons.datapicker.month')}}': [moment().startOf('month'), moment().endOf('month')],
                    '{{__('apps::dashboard.buttons.datapicker.last_month')}}': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
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

            cb(NaN, NaN);

        });
    </script>
    @include('installment::dashboard.installments.components.table')


@stop
