<script>
    function tableGenerate(data = '') {

        var dataTable =
            $('#dataTable').DataTable({
                "createdRow": function (row, data, dataIndex) {
                    if (data["deleted_at"] != null) {
                        $(row).addClass('danger');
                    }
                },
                ajax: {
                    url: "{{ url(route('dashboard.indebted-reports.datatable')) }}",
                    type: "GET",
                    data: {
                        req: data,
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
                    {data: 'id', className: 'dt-center'},
                    {data: 'contract_id', className: 'dt-center'},
                    {
                        data: 'indebtednes',
                        className: 'dt-center',
                        render: function (data, type, full, meta) {
                            return data.client_id;
                        },
                    },
                    {data: 'paid', className: 'dt-center'},
                    {data: 'transaction_date', className: 'dt-center'},
                    {
                        data: 'status',
                        className: 'dt-center',
                        responsivePriority: 1,
                        render: function (data, type, full, meta) {
                            return buildStatusView(data);
                        },
                    },
                    {
                        data: 'id',
                        className: 'dt-center',
                        responsivePriority: 1,
                        render: function (data, type, full, meta) {
                            return buildShow(full);
                        },
                    },
                    {
                        data: 'id',
                        className: 'dt-center',
                        responsivePriority: 1,
                        render: function (data, type, full, meta) {

                            @can('pay_indebtednes')
                                var url = '{{url(route('dashboard.indebtednes.cancel', [':indebtednes',':id']))}}';
                                url = url.replace(':indebtednes', full.contract_id);
                                url = url.replace(':id', data);

                                return '<a onclick="cancelPay(\'' + url + '\')" class="btn btn-info">' +
                                    ' {{__('indebtednes::dashboard.indebtednes-reports.btn.cancel_pay')}}' +
                                    '</a>';
                            @else
                                return '<a disabled class="btn btn-primary">' +
                                '   {{__('indebtednes::dashboard.indebtednes-reports.btn.cancel_pay')}}' +
                                '</a>';
                            @endcan
                        },
                    },
                ],
                columnDefs: [
                    {
                        targets: 0,
                        width: '30px',
                        className: 'dt-center',
                        orderable: false,
                        render: function (data, type, full, meta) {
                            return `<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                          <input type="checkbox" value="` + data + `" class="group-checkable" name="ids">
                          <span></span>
                        </label>
                      `;
                        },
                    },
                ],
                dom: 'Bfrtip',
                lengthMenu: [
                    [10, 25, 50, 100, 500],
                    ['10', '25', '50', '100', '500']
                ],
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
                        extend: "print",
                        className: "btn blue btn-outline",
                        text: "{{__('apps::dashboard.datatable.print')}}",
                        exportOptions: {
                            stripHtml: false,
                            columns: ':visible',
                            columns: [1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: "pdf",
                        className: "btn blue btn-outline",
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


    function buildStatusView(status) {
        switch (status) {
            case 'not_complete':
                return ' <label class="label label-warning">{{__('indebtednes::dashboard.indebtednes-reports.datatable.not_complete')}}</label>';
            case 'completed':
                return ' <label class="label label-success">{{__('indebtednes::dashboard.indebtednes-reports.datatable.completed')}}</label>';
            case 'waiting':
                return ' <label class="label label-danger">{{__('indebtednes::dashboard.indebtednes-reports.datatable.waiting')}}</label>';
        }
    }

    function buildShow(record) {
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
            '                    </button>' + buildStatusView(record.status) +
            '                </div>' +
            '                <div class="modal-body">' +
            '                    <p><strong>' +
            '                            {{__('indebtednes::dashboard.indebtednes-reports.datatable.paid_amount')}}' +
            '                            : </strong> ' + record.paid +
            '                    </p>' +
            '                    <p><strong>' +
            '                            {{__('indebtednes::dashboard.indebtednes-reports.datatable.transaction_date')}}' +
            '                            : </strong>' + record.transaction_date +
            '                    </p>' +
            '                    <p style="    background-color: #5555551f;border-radius: 3px;padding: 13px 7px;">' +
            '                        <strong>' +
            '                            {{__('indebtednes::dashboard.indebtednes-reports.datatable.note')}}' +
            '                            : </strong>' +
            '                        <span>' + (record.note ? record.note : '') + '</span>' +
            '                    </p>' +
            '                </div>' +
            '                <div class="modal-footer">' +
            '                    <button type="button"' +
            '                            class="btn btn-default"' +
            '                            data-dismiss="modal"' +
            '                            style="background-color: #00c0ef;color: white">' +
            '                        {{__('indebtednes::dashboard.indebtednes-reports.btn.cancel')}}' +
            '                    </button>' +
            '                </div>' +
            '            </div>' +
            '        </div>' +
            '    </div>' +
            '</td>';
        return response;
    }
</script>