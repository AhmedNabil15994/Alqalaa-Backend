@extends('apps::dashboard.layouts.app')
@section('title', __('apps::dashboard.printreportsrequests.routes.index'))
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
                    <a href="#">{{__('apps::dashboard.printreportsrequests.routes.index')}}</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">

                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase">
                                {{__('apps::dashboard.printreportsrequests.routes.index')}}
                            </span>
                        </div>
                    </div>

                    {{-- DATATABLE CONTENT --}}
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="dataTable">
                            <thead>
                                <tr>
                                    <th>{{__('apps::dashboard.printreportsrequests.datatable.created_at')}}</th>
                                    <th>{{__('apps::dashboard.printreportsrequests.datatable.status')}}</th>
                                    <th>{{__('apps::dashboard.printreportsrequests.datatable.options')}}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')

  <script>
   function tableGenerate(data='') {

      var dataTable =
      $('#dataTable').DataTable({
          "createdRow": function( row, data, dataIndex ) {
             if ( data["deleted_at"] != null ) {
                $(row).addClass('danger');
             }
          },
          ajax : {
              url   : "{{ url(route('dashboard.print.reports.request.datatable')) }}",
              type  : "GET",
              data  : {
                  req : data,
              },
          },
          language: {
              url:"//cdn.datatables.net/plug-ins/1.10.16/i18n/{{ucfirst(LaravelLocalization::getCurrentLocaleName())}}.json"
          },
          stateSave: true,
          processing: true,
          serverSide: true,
          responsive: !0,
          order     : [[ 1 , "desc" ]],
          columns: [
            {data: 'created_at' 		  , className: 'text-center'},
            {data: 'status' 	        , className: 'text-center'},
            {data: 'id' 		 	        , className: 'text-center'},
      		],
          columnDefs: [
            {
      				targets: 1,
      				width: '30px',
      				className: 'text-center',
      				render: function(data, type, full, meta) {
                        if (data == 1) {
                        return '<span class="badge badge-success"> {{__('apps::dashboard.printreportsrequests.datatable.ready')}} </span>';
                        }else{
                        return '<span class="badge badge-warning"> {{__('apps::dashboard.printreportsrequests.datatable.processing')}} </span>';
                        }
      				},
      			},
            {
              targets: -1,
              width: '13%',
              title: '{{__('apps::dashboard.printreportsrequests.datatable.options')}}',
              className: 'text-center',
              orderable: false,
              render: function(data, type, full, meta) {

                let btns = ``;
                if(full.status == 1){
                    
                    // Edit
                    var editUrl = full.path;
                    editUrl = editUrl.replace(':id', data);

                    // Delete
                    var deleteUrl = '{{ route("dashboard.print.reports.request.destroy", ":id") }}';
                    deleteUrl = deleteUrl.replace(':id', data);

                    btns = `
                    <a href="`+editUrl+`" class="btn btn-sm blue" title="download">
                        <i class="fa fa-download"></i>
                    </a>

                    @csrf
                    <a href="javascript:;" onclick="deleteRow('`+deleteUrl+`')" class="btn btn-sm red">
                        <i class="fa fa-trash"></i>
                    </a>`;

                }
                return btns;
              },
            },
          ],
          dom: 'Bfrtip',
          lengthMenu: [
              [ 10, 25, 50 , 100 , 500 ],
              [ '10', '25', '50', '100' , '500']
          ],
  				buttons:[
  					{
    						extend: "pageLength",
                className: "btn blue btn-outline",
                text: "{{__('apps::dashboard.datatable.pageLength')}}",
                exportOptions: {
                    stripHtml : false,
                    columns: ':visible',
                    columns: [ 1 , 2 , 3 , 4 , 5]
                }
  					},
  					{
    						extend: "print",
                className: "btn blue btn-outline" ,
                text: "{{__('apps::dashboard.datatable.print')}}",
                exportOptions: {
                    stripHtml : false,
                    columns: ':visible',
                    columns: [ 1 , 2 , 3 , 4 , 5]
                }
  					},
  					{
  							extend: "pdf",
                className: "btn blue btn-outline" ,
                text: "{{__('apps::dashboard.datatable.pdf')}}",
                exportOptions: {
                    stripHtml : false,
                    columns: ':visible',
                    columns: [ 1 , 2 , 3 , 4 , 5]
                }
  					},
  					{
  							extend: "excel",
                className: "btn blue btn-outline " ,
                text: "{{__('apps::dashboard.datatable.excel')}}",
                exportOptions: {
                    stripHtml : false,
                    columns: ':visible',
                    columns: [ 1 , 2 , 3 , 4 , 5]
                }
  					},
  					{
  							extend: "colvis",
                className: "btn blue btn-outline",
                text: "{{__('apps::dashboard.datatable.colvis')}}",
                exportOptions: {
                    stripHtml : false,
                    columns: ':visible',
                    columns: [ 1 , 2 , 3 , 4 , 5]
                }
  					}
  				]
      });
  }

  jQuery(document).ready(function() {
  	tableGenerate();
  });
  </script>

@stop
