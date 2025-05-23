<script>
    function tableGenerate(data = '') {

        var dataTable =
            $('#dataTable').DataTable({
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
                    url: "{{ isset($datatable_url) ? $datatable_url : route('dashboard.contracts.datatable')}}",
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
                    {data: 'contract_number', className: 'text-center'},
                    {data: 'created_user', orderable: false,className: 'text-center'},
                    {data: 'client_id', className: 'text-center'},
                    
                    @can('show_contract_amount')
                        {data: 'price', className: 'text-center'},
                    @endcan
                    
                    @can('show_contract_down_payment')
                        {data: 'down_payment', className: 'text-center'},
                    @endcan

                    {data: 'remaining', className: 'text-center'},
                    {data: 'installment_with_fees', className: 'text-center'},
                    {data: 'overdue_amounts', className: 'text-center'},
                    
                    @can('show_installment_fees')
                        {
                            data: 'installment_fees',
                            className: 'text-center',
                            render: function (data, type, full, meta) {
                                return '<span class="badge badge-primary"> ' + data + ' %</span>';
                            },
                        },
                    @endcan

                    {data: 'months_num', className: 'text-center'},
                    {data: 'installment_value', className: 'text-center'},
                    
                    @can('show_contract_paid_amount')
                        {data: 'paid', className: 'text-center', orderable: false},
                    @endcan
                    
                    @can('show_contract_profit')
                        {
                            data: 'profit',
                            orderable: false,
                            className: 'text-center',
                            render: function (data, type, full, meta) {
                                return '<span class="badge badge-success"> ' + data + '</span>';
                            },
                        },
                    @endcan

                    {
                        data: 'completed_at',
                        className: 'text-center',
                        render: function (data, type, full, meta) {
                            if (data) {
                                return '<span class="badge badge-success"> ' + data + ' </span>';
                            } else {
                                return '<span class="badge badge-danger"> {{__('contract::dashboard.contracts.datatable.not_completed')}} </span>'
                            }
                        },
                    },
                    {data: 'created_at', visible: true, className: 'text-center'},
                    {
                        data: 'options',
                        orderable: false,
                        className: 'text-center',
                        width: '130px',
                        responsivePriority: 1
                    },
                ],
                "fnDrawCallback": function () {
                    //Initialize checkbos for enable/disable user
                    $("[name='switch']").bootstrapSwitch({size: "small", onColor: "success", offColor: "danger"});
                    $("#dataTable").css("width", "0px");
                },
                dom: 'Bfrtip',
                lengthMenu: [
                    [10, 25, 50, 100, 500, 1000, 1500],
                    ['10', '25', '50', '100', '500', '1000', '1500']
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
                        url: "{{isset($exportStatus) ? route('dashboard.contracts.export' , ['print',$exportStatus]) : route('dashboard.contracts.export' , 'print')}}",
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
                        url: "{{isset($exportStatus) ? route('dashboard.contracts.export' , ['pdf',$exportStatus]) : route('dashboard.contracts.export' , 'pdf')}}",
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
                        url: "{{isset($exportStatus) ? route('dashboard.contracts.export' , ['excel',$exportStatus]) : route('dashboard.contracts.export' , 'excel')}}",
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

        @if(request('complete_status'))
        var $form = $("#formFilter");
        var data = getFormData($form);
        tableGenerate(data);
        @else
        tableGenerate();
        @endif
    });
</script>