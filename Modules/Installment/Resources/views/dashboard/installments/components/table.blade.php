<script>
    var dataTable;

    function tableGenerate(data = '', action = '') {
        dataTable =
            $('#dataTable').// on('xhr.dt', function ( e, settings, json, xhr ) {
            //     actions(action,json);
            // }).
            DataTable({
                "createdRow": function (row, data, dataIndex) {
                    if (data["deleted_at"] != null) {
                        $(row).addClass('danger');
                    }
                    if (data["id"] === '{{__('contract::dashboard.contracts.datatable.total')}}') {
                        $(row).addClass('success');
                        $(row).addClass('without-hover');
                        $(row).hover(function () {
                            $(row).css("background-color", "transparent");
                        });
                    }
                },
                ajax: {
                    url: "{{ url(route($datatableRoute)) }}",
                    type: "GET",
                    data: {
                        req: data,
                        action: action,
                    },
                },
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/{{ucfirst(LaravelLocalization::getCurrentLocaleName())}}.json"
                },
                stateSave: true,
                processing: true,
                serverSide: true,
                responsive: !0,
                order: [[1, "desc"]],
                columns: [
                    {
                        data: 'id',
                        width: '30px',
                        className: 'dt-center',
                        responsivePriority: 1,
                        orderable: false,
                        render: function (data, type, full, meta) {
                            if (full.status_check !== 'completed') {

                                return `<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                      <input type="checkbox" value="` + data + `" class="group-checkable ids" name="ids" onchange="checkboxChange(` + data + `)"
                                        id="row_checkbox_` + data + `" target="` + data + `">
                                      <span></span>
                                    </label>
                                  `;
                            } else {
                                return '';
                            }
                        },
                    },
                    {
                        data: 'remaining',
                        width: '10px',
                        className: 'dt-center',
                        responsivePriority: 1,
                        render: function (data, type, full, meta) {
                            if (full.status_check !== 'completed') {
                                var field = `{!! field('installment_remaining')->number('remaining_:id' , '' ,':value' ,[
                                'class'=>'form-control input-small',
                                'readonly' => 'readonly',
                                'onkeyup' => 'changeRemaining(:id,:max)',
                                ]) !!}`;
                                field = replaceAll(field, ':id', full.id);
                                field = field.replace(':value', data);
                                field = field.replace(':max', data);
                                return field;
                            } else {
                                return '';
                            }
                        },
                    },
                    {data: 'id', className: 'dt-center', responsivePriority: 1},
                    {
                        data: 'contract',
                        className: 'dt-center',
                        orderable: false,
                        responsivePriority: 1,
                        render: function (data, type, full, meta) {

                            return data != '----' ? data.client_name : '----';
                        },
                    },
                    {data: 'contract_id',
                        responsivePriority: 1,
                        className: 'dt-center',
                        render: function (data, type, full, meta) {
                            return full.contract_number;
                        },
                    },
                    {data: 'amount', responsivePriority: 1, className: 'dt-center'},
                    {data: 'paid', responsivePriority: 1, className: 'dt-center'},
                    {data: 'remaining', responsivePriority: 1, className: 'dt-center'},
                    {
                        data: 'due_date',
                        className: 'dt-center',
                        responsivePriority: 1,
                        render: function (data, type, full, meta) {
                            if (full.contract_id != '----') {
                                @can('edit_installments_due_date')
                                return updateDueDateForm(full);
                                @else
                                    return data;
                                @endcan
                            }else{
                                return '----'
                            }
                        },
                    },
                    {data: 'transaction_date', responsivePriority: 1, className: 'dt-center'},
                    {data: 'offer_percentage', responsivePriority: 1, className: 'dt-center'},
                    {data: 'status', className: 'dt-center', orderable: false, responsivePriority: 1},
                    {
                        data: 'id',
                        className: 'dt-center',
                        responsivePriority: 1,
                        render: function (data, type, full, meta) {

                            if (full.contract_id != '----') {
                                return buildShow(full);
                            }else{
                                return '----'
                            }
                        },
                    },
                    @if(auth()->user()->can('pay_installments') || auth()->user()->can('can_cancel_installments_pay'))
                    {
                        data: 'id',
                        className: 'dt-center',
                        responsivePriority: 1,
                        render: function (data, type, full, meta) {


                            if (full.contract_id != '----') {


                                if (full.transaction_date == null) {


                                    @can('pay_installments')

                                        if (full.valid_to_pay) {
                                            var full_data = JSON.stringify(full);
                                            return '<a onclick="openPayModel(' + full.id + ',' + full.contract_id + ',' + full.amount + ',' + full.paid + ',' + full.remaining + ',' + full.contract_number+ ')" class="btn btn-primary">' +
                                                '   {{__('installment::dashboard.installments.btn.pay_installment')}}' +
                                                '</a>'  +
                                                '<a onclick="sendWhatsapp(' + full.id + ',' + full.contract_id + ',' + full.amount + ',' + full.paid + ',' + full.remaining + ',' + full.contract_number+ ')" class="btn btn-success" style="margin-top:10px">' +
                                                ' <i class="fa fa-whatsapp"></i>  {{__('installment::dashboard.installments.btn.send_whatsapp')}}' +
                                                '</a>';
                                        } else {
                                            return `
                                                <a class="btn btn-warning">
                                                    {{__('contract::client.contracts.show.btn.closed_to_pay')}}
                                                </a>
                                                `;
                                        }
                                    @else
                                        return '';
                                    @endcan

                                } else {

                                    @can('can_cancel_installments_pay')
                                        var url = '{{url(route('dashboard.installments.cancel', ':id'))}}';
                                        url = url.replace(':id', data);
                                        let link = '<a onclick="cancelPay(\'' + url + '\')" class="btn btn-info">' +
                                            ' {{__('installment::dashboard.installments.btn.cancel_pay')}}' +
                                            '</a>';
                                        return link;
                                    @else
                                        return '';
                                    @endcan
                                }

                            }else{
                                return '----'
                            }
                        },
                    },
                    @endif
                ],
                lengthMenu: [
                    [10, 25, 50, 100, 500],
                    ['10', '25', '50', '100', '500']
                ],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: "pageLength",
                        className: "btn blue btn-outline",
                        text: "{{__('apps::dashboard.datatable.pageLength')}}",
                        exportOptions: {
                            stripHtml: false,
                            columns: ':visible',
                            columns: [1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: "pdf",
                        print_type:"queue_file",
                        className: "btn blue btn-outline",
                        text: "{{__('apps::dashboard.datatable.print')}}",
                        url: "{{url(route('dashboard.installments.export' . ($datatableRoute == 'dashboard.installments.datatable'? '' : '.judging') , 'print'))}}",
                        data: {
                            req: data,
                        },
                        exportOptions: {
                            stripHtml: false,
                            columns: ':visible',
                            columns: [1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: "pdf",
                        className: "btn blue btn-outline",
                        print_type:"queue_file",
                        url: "{{url(route('dashboard.installments.export' . ($datatableRoute == 'dashboard.installments.datatable'? '' : '.judging') , 'pdf'))}}",
                        data: {
                            req: data,
                        },
                        text: "{{__('apps::dashboard.datatable.pdf')}}",
                        exportOptions: {
                            stripHtml: false,
                            columns: ':visible',
                            columns: [1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: "excel",
                        className: "btn blue btn-outline ",
                        url: "{{url(route('dashboard.installments.export.excel' . ($datatableRoute == 'dashboard.installments.datatable'? '' : '.judging') , 'excel'))}}",
                        data: {
                            req: data,
                        },
                        text: "{{__('apps::dashboard.datatable.excel')}}",
                        exportOptions: {
                            stripHtml: false,
                            columns: ':visible',
                            columns: [1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: "colvis",
                        className: "btn blue btn-outline",
                        text: "{{__('apps::dashboard.datatable.colvis')}}",
                        exportOptions: {
                            stripHtml: false,
                            columns: ':visible',
                            columns: [1, 2, 3, 4, 5]
                        }
                    }
                ]
            });
    }

    jQuery(document).ready(function () {
        tableGenerate();
    });

    function changeRemaining(id, max) {
        var $first;
        var $value;
        var $remaining = $('#remaining_' + id);
        var $remaining_value = $remaining.val();

        dataTable.rows().every(function () {
            $first = $(dataTable.cell(this.index(), 1).node()).find($remaining).val();

            if ($first)
                $remaining_value = $first;
        });

        $remaining.val($remaining_value);
    }

    function checkboxChange(id) {
        var $remaning = $('#remaining_' + id);

        if ($('#row_checkbox_' + id).is(':checked')) {
            $remaning.attr("readonly", false);
        } else {
            $remaning.attr("readonly", true);
        }
    }

    function buildShow(record) {

        let link = '';

        if(record.status_check != 'waiting'){

            let printUrl = '{{route('installments.print','::id')}}';
            printUrl = printUrl.replace('::id', record.id);
            link = `<button onclick="printFromUrl('${printUrl}')" class="btn btn-info">{{__('installment::dashboard.installments.btn.print_invoice')}}</button>`;
        }

        var response =
            '<td class="text-center">' +
            '    <a class="btn-icon" data-toggle="modal"' +
            '       data-target="#show-' + record.id + '">' +
            '        <i class="btn btn-xs btn-info fa fa-eye"' +
            '           style="padding: 4px 6px"></i>' +
            '    </a>' +
            '    <div class="modal fade"' +
            '         id="show-' + record.id + '"' +
            '         tabindex="-1"' +
            '         role="dialog"' +
            '         aria-labelledby="myModalLabel">' +
            '        <div class="modal-dialog"' +
            '             role="document">' +
            '            <div class="modal-content">' +
            '                <div class="modal-header">' +
            '                    <button type="button"' +
            '                            class="close"' +
            '                            data-dismiss="modal"' +
            '                            aria-label="Close"><span' +
            '                                aria-hidden="true">&times;</span>' +
            '                    </button>' + record.status +
            '                </div>' +
            '                <div class="modal-body">' +
            '                    <p><strong>' +
            '                            {{__('installment::dashboard.installments.datatable.asked_amount')}}' +
            '                            : </strong> ' + record.amount +
            '                    </p>' +
            '                    <p><strong>' +
            '                            {{__('installment::dashboard.installments.datatable.paid_amount')}}' +
            '                            : </strong> ' + record.paid +
            '                    </p>' +
            '                    <p><strong>' +
            '                            {{__('installment::dashboard.installments.datatable.remaining_amount')}}' +
            '                            : </strong> ' + record.remaining +
            '                    </p>' +
            '                    <p><strong>' +
            '                            {{__('installment::dashboard.installments.datatable.due_date')}}' +
            '                            : </strong> ' + record.due_date +
            '                    </p>' +
            '                    <p><strong>' +
            '                            {{__('installment::dashboard.installments.datatable.transaction_date')}}' +
            '                            : </strong>' + record.transaction_date +
            '                    </p>' +
            '                    <p><strong>' +
            '                            {{__('installment::dashboard.installments.datatable.offer')}}' +
            '                            : </strong>' + record.offer_percentage +
            '                    </p>' +
            '                    <p style="    background-color: #5555551f;border-radius: 3px;padding: 13px 7px;">' +
            '                        <strong>' +
            '                            {{__('installment::dashboard.installments.datatable.note')}}' +
            '                            : </strong>' +
            '                        <span>' + (record.note ? record.note : '') + '</span>' +
            '                    </p>' +
            '                    <br>' +
            '                        <p><strong>' +
            '                                {{__('installment::dashboard.installments.datatable.old_paid_amount')}}' +
            '                                : </strong></p>' +
            '                        <table class="data-table table table-bordered">' +
            '                            <thead>' +
            '                            <th class="text-center">#</th>' +
            '                            <th class="text-center">{{__('installment::dashboard.installments.datatable.paid_amount')}}</th>' +
            '                            <th class="text-center">{{__('installment::dashboard.installments.datatable.transaction_date')}}</th>' +
            '                            <th class="text-center">{{__('installment::dashboard.installments.datatable.note')}}</th>' +
            '                            <th class="text-center">{{__('installment::dashboard.installments.btn.paied_by')}}</th>' +

                                        @can('can_cancel_installments_pay')
            '                            <th class="text-center">{{__('installment::dashboard.installments.btn.cancel_pay')}}</th>' +
                                        @endcan
            '                            </thead>' +
            '                            <tbody>' + buildTablePayment(record.payments) + '</tbody>' +
            '                        </table>' +
            '                    <br>' +
            '                </div>' +
            '                <div class="modal-footer">' +
            '                    <button type="button"' +
            '                            class="btn btn-default"' +
            '                            data-dismiss="modal"' +
            '                            style="background-color: #00c0ef;color: white">' +
            '                        {{__('installment::dashboard.installments.btn.cancel')}}' +
            '                    </button> '+ link +
            '                </div>' +
            '            </div>' +
            '        </div>' +
            '    </div>' +
            '</td>';
        return response;
    }

    function buildTablePayment(payments) {

        var table = '';

        $.each(payments, function (index, payment) {
            var url = '{{url(route('dashboard.installments.payments.cancel', ':id'))}}';
            url = url.replace(':id', payment.id);
            var option =
                '<tr>' +
                '    <td>' + payment.id + '</td>' +
                '    <td>' + payment.amount + '</td>' +
                '    <td>' + payment.transaction_date + '</td>' +
                '    <td>' + (payment.note ? payment.note : '') + '</td>' +
                '    <td>' + payment.pay_by_type +'<br>'+ payment.user + '</td>' +

                @can('can_cancel_installments_pay')
                '    <td>' +
                        '        <a class="btn btn-info"' +
                '           onclick="cancelPay(\'' + url + '\')" >' +
                '            {{__('installment::dashboard.installments.btn.cancel_pay')}}' +
                '        </a>' +
                        '    </td>' +
                    @endcan
                '</tr>'
            ;
            table += option;
        });

        return table;
    }


    function escapeRegExp(string) {
        return string.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");
    }

    /* Define functin to find and replace specified term with replacement string */
    function replaceAll(str, term, replacement) {
        return str.replace(new RegExp(escapeRegExp(term), 'g'), replacement);
    }

    function updateDueDateForm(full) {

        return `
            <div class="due_date_content">
                {!! field('installment_remaining')->date('due_date' , '' ,'${full.due_date}' ,['class'=>'form-control input-small due_date_input','readonly' => 'readonly']) !!}

                <button class="btn btn-sm btn-success fa-edit-due-date" title="show" onclick="openEditDueDate(this)">
                    <i class="fa fa-edit"></i>
                </button>
                <div class="edit-due-date-btns-form" style="display:none;">
                    <button class="btn btn-sm btn-success" title="save" onclick="updateDueDate(this,${full.id})">
                        <i class="fa fa-check"></i>
                    </button>
                    <button class="btn btn-sm btn-danger" title="close" onclick="closeEditDueDate(this)">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
            </div>
        `;
    }

    function openEditDueDate(btn) {
        btn = $(btn);
        btn.hide();
        btn.parent().find('.due_date_input').removeAttr('readonly');
        btn.parent().find('.edit-due-date-btns-form').show();
    }

    function closeEditDueDate(btn) {
        btn = $(btn).parent();
        btn.hide();
        btn.parent().find('.due_date_input').attr('readonly','readonly');
        btn.parent().find('.fa-edit-due-date').show();
    }

    function updateDueDate(btn,id) {
        let successBtn = $(btn);
        let date = successBtn.parent().parent().find('.due_date_input').first().val();
        successBtn.prop('disabled', true);

        var url = '{{ route("dashboard.installments.update.due.date", ":id") }}';
        url = url.replace(':id', id);
        $.ajax({

            url: url,
            type: 'get',
            dataType: 'JSON',
            data: {
                'date':date
            },

            success: function (data) {

                successBtn.prop('disabled', false);
                toastr["success"](data.message);
                closeEditDueDate(btn)
            },
            error: function (data) {

                successBtn.prop('disabled', false);
                toastr["error"](data.message);

            },
        });
    }
</script>
