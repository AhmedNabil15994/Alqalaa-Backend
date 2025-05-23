
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
                    url: "{{ url(route('dashboard.clients.datatable').(request('is_judging')?'?is_judging='.request('is_judging'):'')) }}",
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
                    {data: 'id', className: 'dt-center', width: '30px', orderable: false,
                        render: function (data, type, full, meta) {
                            return `
                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                      <input type="checkbox" value="` + data + `" class="group-checkable" name="ids">
                                      <span></span>
                                    </label>
                              `;
                        }
                    },
                    {data: 'id', className: 'dt-center'},
                    {data: 'name', className: 'dt-center'},
                    {data: 'email', className: 'dt-center'},
                    {data: 'phone', className: 'dt-center', orderable: false},
                    {data: 'national_ID', className: 'dt-center'},
                    {data: 'state_id', className: 'dt-center', orderable: false},
                    {data: 'labels', className: 'dt-center', orderable: false},
                    {data: 'created_at', visible:true,className: 'dt-center'},
                    {
                        data: "is_judging",
                        responsivePriority: 1,
                        orderable: false,
                        className: 'dt-center',
                        render: function(data, type, full, meta) {
                            if (data === 0) {
                                return '<span class="badge badge-success"> {{__('apps::dashboard.datatable.unactive')}} </span>';
                            }else{
                                return '<span class="badge badge-danger"> {{__('apps::dashboard.datatable.active')}} </span>';
                            }
                        },
                    },
                    {data: "status",responsivePriority: 1,className: 'dt-center'},
                    {data: 'options', responsivePriority: 1,orderable: false, className: 'dt-center'},
                ],
                "fnDrawCallback": function() {
                    //Initialize checkbos for enable/disable user
                    $("[name='switch']").bootstrapSwitch({size: "small", onColor:"success", offColor:"danger"});
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
                        extend: "print",
                        className: "btn blue btn-outline",
                        text: "{{__('apps::dashboard.datatable.print')}}",
                        exportOptions: {
                            stripHtml: true,
                            columns: ':visible'
                        }
                    },
                    {
                        extend: "pdf",
                        className: "btn blue btn-outline",
                        text: "{{__('apps::dashboard.datatable.pdf')}}",
                        url: "{{url(route('dashboard.clients.export' , 'pdf').(request('is_judging')?'?is_judging='.request('is_judging'):''))}}",
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