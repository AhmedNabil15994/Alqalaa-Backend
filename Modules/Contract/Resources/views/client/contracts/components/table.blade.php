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
                    url: "{{ url(route('client.contracts.datatable')) }}",
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
                    {data: 'contract_number', className: 'dt-center'},
                    {data: 'installment_with_fees', className: 'dt-center'},
                    {data: 'months_num', className: 'dt-center'},
                    {data: 'installment_value', className: 'dt-center'},
                    {data: 'paid', className: 'dt-center'},
                    {data: 'remaining', className: 'dt-center'},
                    {
                        data: 'completed_at',
                        className: 'dt-center',
                        render: function (data, type, full, meta) {
                            if (data) {
                                return '<span class="badge badge-success"> ' + data + ' </span>';
                            } else {
                                return '<span class="badge badge-danger"> {{__('contract::client.contracts.datatable.not_completed')}} </span>'
                            }
                        },
                    },
                    {data: 'created_at', visible: true, className: 'dt-center'},
                    {
                        data: 'id',
                        responsivePriority: 1,
                        orderable: false,
                        className: 'dt-center',
                        render: function (data, type, full, meta) {

                            // show
                            var showUrl = '{{ route("client.contracts.show", ":id") }}';
                            showUrl = showUrl.replace(':id', data);

                            return  `<a href="`+showUrl+`" class="btn btn-sm btn-warning" title="Show">
                                         <i class="fa fa-eye"></i>
                                     </a>`;
                        },
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
                        text: "{{__('apps::client.datatable.pageLength')}}",
                        exportOptions: {
                            stripHtml: true,
                            columns: ':visible'
                        }
                    },
                    {
                        extend: "print",
                        className: "btn blue btn-outline",
                        text: "{{__('apps::client.datatable.print')}}",
                        exportOptions: {
                            stripHtml: true,
                            columns: ':visible'
                        }
                    },
                    {
                        extend: "pdf",
                        className: "btn blue btn-outline",
                        text: "{{__('apps::client.datatable.pdf')}}",
                        exportOptions: {
                            stripHtml: true,
                            columns: ':visible'
                        }
                    },
                    {
                        extend: "excel",
                        className: "btn blue btn-outline ",
                        text: "{{__('apps::client.datatable.excel')}}",
                        exportOptions: {
                            stripHtml: true,
                            columns: ':visible'
                        }
                    },
                    {
                        extend: "colvis",
                        className: "btn blue btn-outline",
                        text: "{{__('apps::client.datatable.colvis')}}",
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