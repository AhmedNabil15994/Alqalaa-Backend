@extends('apps::dashboard.layouts.app')
@section('title', __('indebtednes::dashboard.indebtednes.routes.index'))
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
                        <a href="#">{{__('indebtednes::dashboard.indebtednes.routes.index')}}</a>
                    </li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">

                        <div class="table-toolbar">
                            <div class="row">
                                @can('add_indebtednes')
                                    <div class="col-lg-1" style="margin: 3px 2px;">
                                        <div class="btn-group">
                                            <a href="{{ url(route('dashboard.indebtednes.create')) }}"
                                               class="btn sbold green">
                                                <i class="fa fa-plus"></i> {{__('apps::dashboard.buttons.add_new')}}
                                            </a>
                                        </div>
                                    </div>
                                @endcan
                            </div>
                        </div>

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
                                                        </div>
                                                        <input name="client_id" type="hidden"
                                                               value="{{request('client_id') ?? '' }}">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <div class="mt-radio-list">
                                                                    <label class="mt-radio">
                                                                        {{__('apps::dashboard.datatable.form.delete_only')}}
                                                                        <input type="radio" value="only"
                                                                               name="deleted"/>
                                                                        <span></span>
                                                                    </label>
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
                                {{__('indebtednes::dashboard.indebtednes.routes.index')}}
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
                                    <th>#</th>
                                    <th>{{__('indebtednes::dashboard.indebtednes.datatable.client')}}</th>
                                    <th>{{__('indebtednes::dashboard.indebtednes.datatable.price')}}</th>
                                    <th>{{__('indebtednes::dashboard.indebtednes.datatable.remaining')}}</th>
                                    <th>{{__('indebtednes::dashboard.indebtednes.datatable.paid')}}</th>

                                    @if(request('client_id'))
                                        <th>{{__('indebtednes::dashboard.indebtednes.datatable.details')}}</th>
                                        <th>{{__('indebtednes::dashboard.indebtednes.datatable.completed_at')}}</th>
                                        <th>{{__('indebtednes::dashboard.indebtednes.datatable.created_at')}}</th>
                                    @endif
                                    <th>{{__('indebtednes::dashboard.indebtednes.show.info.instalments_details.pay')}} </th>

                                    @if(!request('client_id'))
                                        <th>{{__('indebtednes::dashboard.indebtednes.datatable.indebtednes')}}</th>
                                    @endif

                                    <th>{{__('indebtednes::dashboard.indebtednes.datatable.options')}}</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <button type="submit" id="deleteChecked" class="btn red btn-sm"
                                        onclick="deleteAllChecked('{{ url(route('dashboard.indebtednes.deletes')) }}')">
                                    {{__('apps::dashboard.datatable.delete_all_btn')}}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade bd-example-modal-lg"
         id="pay-indebtednes"
         tabindex="-1"
         role="dialog"
         aria-labelledby="myLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <h4 class="modal-title">
                        {{__('indebtednes::dashboard.indebtednes.show.btn.pay_installment')}}
                    </h4>
                </div>
                <div class="modal-body">
                    {!! Form::open([
                        'url' => url(route('dashboard.indebtednes.pay','::id')),
                        'id'=>'indebtednes-form',
                        'method' => 'put',
                    ]) !!}

                    <input type="hidden" name="indebtednes_id" id="indebtednes_id">
                    {!! field()->number('indebt_number' ,__('indebtednes::dashboard.indebtednes.show.info.instalments_details.indebtednes_id'), null , ['readonly' => 'readonly']) !!}
                    {!! field()->number('amount' ,__('indebtednes::dashboard.indebtednes.show.info.instalments_details.total_amount') , '::amount' , ['readonly' => 'readonly']) !!}
                    {!! field()->number('paid' ,__('indebtednes::dashboard.indebtednes.show.info.instalments_details.paid_amount') , '::paid' , ['readonly' => 'readonly']) !!}
                    {!! field()->number('remaining' ,__('indebtednes::dashboard.indebtednes.show.info.instalments_details.remaining_amount'), '::remaining' , ['readonly' => 'readonly']) !!}
                    {!! field()->number('pay_now' ,__('indebtednes::dashboard.indebtednes.show.info.instalments_details.pay_amount') , '::remaining',['step'=> '0.01']) !!}
                    {!! field()->date('transaction_date' ,__('indebtednes::dashboard.indebtednes.show.info.instalments_details.transaction_date')) !!}
                    {!! field()->textarea('note',__('indebtednes::dashboard.indebtednes.show.info.instalments_details.note'),null,['class' => 'form-control']) !!}
                </div>
                <div class="modal-footer">
                    <div class="clearfix"></div>
                    <br>
                    <button type="button"
                            class="btn btn-white"
                            data-dismiss="modal">
                        {{__('indebtednes::dashboard.indebtednes.show.btn.cancel')}}
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


        function openPayModel(id, amount, paid, remaining, indebt_number) {

            resetErrors();
            var $form = $('#indebtednes-form');
            var url = '{{ route('dashboard.indebtednes.pay',':id') }}';
            url = url.replace(':id', id);
            $form.attr('action', url);
            $('#amount').val(amount);
            $('#paid').val(paid);
            $('#remaining').val(remaining);
            $('#pay_now').val(remaining);
            $('#indebtednes_id').val(id);
            $('#indebt_number').val(indebt_number);
            $("#pay-indebtednes").modal('show');
        }

        function cancelPay(url) {
            $(".modal").modal('hide');
            swal({
                title: "{{__('indebtednes::dashboard.indebtednes.show.titles.are_you_sure_cancel_pay')}}",
                icon: "warning",
                buttons: {
                    cancel: {
                        text: '{{__('indebtednes::dashboard.indebtednes.show.btn.cancel')}}',
                        value: false,
                        visible: true,
                        className: "",
                        closeModal: true,
                    },
                    confirm: {
                        text: '{{__('indebtednes::dashboard.indebtednes.show.btn.confirm')}}',
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
                        type: 'PUT',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
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

        $('#indebtednes-form').on('submit', function (e) {
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
                        $(".modal").modal('hide');
                        redirect(data);
                        successfully(data);
                        resetErrors();
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


        function refreshInstalmentTable() {

            $(".modal").modal('hide');
            $('#dataTable').DataTable().destroy();
            tableGenerate();
        }
    </script>
    @include('indebtednes::dashboard.indebtednes.components.table')
@stop
