<script>
    function tableGenerate(data = '') {
        var params = new URLSearchParams(window.location.search);
        params = params.has('client_id') ? '?client_id=' + params.get('client_id') : '';

        var dataTable =
            $('#dataTable').DataTable({
                "createdRow": function (row, data, dataIndex) {
                    if (data["deleted_at"] != null) {
                        $(row).addClass('danger');
                    }
                    if (data["id"] === '{{__('indebtednes::dashboard.indebtednes.datatable.total')}}') {
                        $(row).addClass('success');
                        $(row).addClass('without-hover');
                        $(row).hover(function () {
                            $(row).css("background-color", "transparent");
                        });
                    }
                },
                ajax: {
                    url: "{{ url(route('dashboard.indebtednes.datatable')) }}" + params,
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
                responsive: true,
                order: [[1, "desc"]],
                columns: [
                    {
                        data: 'id', className: 'text-center', width: '30px', orderable: false,
                        render: function (data, type, full, meta) {
                            return `
                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                      <input type="checkbox" value="` + data + `" class="group-checkable" name="ids">
                                      <span></span>
                                    </label>
                              `;
                        }
                    },
                    {data: 'indebt_number', className: 'text-center'},
                    {data: 'client_id', className: 'text-center'},
                    {data: 'price', className: 'text-center'},
                    {data: 'remaining', className: 'text-center'},
                    {data: 'paid', className: 'text-center', orderable: false},

                        @if(request('client_id'))
                    {
                        data: 'details', orderable: false, className: 'text-center'
                    },
                    {
                        data: 'completed_at',
                        className: 'text-center',
                        render: function (data, type, full, meta) {
                            if (data) {
                                return '<span class="badge badge-success"> ' + data + ' </span>';
                            } else {
                                return '<span class="badge badge-danger"> {{__('indebtednes::dashboard.indebtednes.datatable.not_completed')}} </span>'
                            }
                        },
                    },
                    {data: 'created_at', visible: true, className: 'text-center'},
                        @endif
                    {
                        data: 'id',
                        visible: true,
                        className: 'text-center',
                        responsivePriority: 1,
                        render: function (data, type, full, meta) {

                            if (data == '{{__('indebtednes::dashboard.indebtednes.datatable.total')}}') {
                                return '----';
                            }

                            if (full.completed_at == null) {

                                return '<a onclick="openPayModel(' + full.id + ',' + full.price + ',' + full.paid + ',' + full.remaining + ',' + full.indebt_number + ')" class="btn btn-xs btn-primary">' +
                                    '   {{__('indebtednes::dashboard.indebtednes.show.btn.pay_installment')}}' +
                                    '</a>';

                            } else {

                                return '<span class="badge badge-success"> {{__('indebtednes::dashboard.indebtednes.datatable.pay_completed')}} </span>';
                                var url = '{{url(route('dashboard.indebtednes.cancel', [':indebtednes',':id']))}}';
                                url = url.replace(':id', data);
                                url = url.replace(':indebtednes', full.indebtednes_id);

                                return '<a onclick="cancelPay(\'' + url + '\')" class="btn btn-info">' +
                                    ' {{__('indebtednes::dashboard.indebtednes.show.btn.cancel_pay')}}' +
                                    '</a>';
                            }
                        },
                    },
                        @if(!request('client_id'))
                    {
                        data: 'indebtednes_client_id',
                        responsivePriority: 1,
                        orderable: false,
                        className: 'text-center',
                        render: function (data, type, full, meta) {
                            if (full.id == '{{__('indebtednes::dashboard.indebtednes.datatable.total')}}') {
                                return '----';
                            }

                            return '<a href="{{ url(route('dashboard.indebtednes.index')) }}?client_id=' + data + '" class="btn btn-xs btn-primary">' +
                                '   {{__('indebtednes::dashboard.indebtednes.show.btn.all_indebtednes')}}' +
                                '</a>';

                        },
                    },
                        @endif
                    {
                        data: 'options', responsivePriority: 1, orderable: false, className: 'text-center'
                    },
                ],
                "fnDrawCallback": function () {
                    //Initialize checkbos for enable/disable user
                    $("[name='switch']").bootstrapSwitch({size: "small", onColor: "success", offColor: "danger"});
                },
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
                            stripHtml: true,
                            columns: ':visible'
                        }
                    },
                    {
                        extend: "pdf",
                        className: "btn blue btn-outline",
                        text: "{{__('apps::dashboard.datatable.print')}}",
                        url: "{{url(route('dashboard.indebtednes.export' , 'print'))}}" + params,
                        data: {
                            req: data,
                        },
                        exportOptions: {
                            stripHtml: true,
                            columns: ':visible'
                        }
                    },
                    {
                        extend: "pdf",
                        className: "btn blue btn-outline",
                        text: "{{__('apps::dashboard.datatable.pdf')}}",
                        url: "{{url(route('dashboard.indebtednes.export' , 'pdf'))}}" + params,
                        data: {
                            req: data,
                        },
                        exportOptions: {
                            stripHtml: true,
                            columns: ':visible'
                        }
                    },
                    {
                        extend: "excel",
                        className: "btn blue btn-outline ",
                        text: "{{__('apps::dashboard.datatable.excel')}}",
                        url: "{{url(route('dashboard.indebtednes.export' , 'excel'))}}" + params,
                        data: {
                            req: data,
                        },
                        exportOptions: {
                            stripHtml: true,
                            columns: ':visible'
                        }
                    },
                    {
                        extend: "colvis",
                        className: "btn blue btn-outline",
                        text: "{{__('apps::dashboard.datatable.colvis')}}",
                        exportOptions: {
                            stripHtml: true,
                            columns: ':visible'
                        }
                    }
                ],
            });

    }

    jQuery(document).ready(function () {
        tableGenerate();
    });
</script>