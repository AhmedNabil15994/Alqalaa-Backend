@extends('apps::dashboard.layouts.app')
@section('title', __('catalog::dashboard.labels.routes.index'))
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
                    <a href="#">{{__('catalog::dashboard.labels.routes.index')}}</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered">

                   @can('add_labels')
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="btn-group">
                                        <a href="{{ url(route('dashboard.labels.create')) }}" class="btn sbold green">
                                            <i class="fa fa-plus"></i> {{__('apps::dashboard.buttons.add_new')}}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                   @endcan



                    <div class="portlet-title">
                        <div class="caption font-dark">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject bold uppercase">
                                {{__('catalog::dashboard.labels.routes.index')}}
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
                                    <th>{{__('catalog::dashboard.labels.datatable.title')}}</th>
                                    <th>{{__('catalog::dashboard.labels.datatable.color')}}</th>
                                    <th>{{__('catalog::dashboard.labels.datatable.created_at')}}</th>
                                    <th>{{__('catalog::dashboard.labels.datatable.options')}}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <button type="submit" id="deleteChecked" class="btn red btn-sm" onclick="deleteAllChecked('{{ url(route('dashboard.labels.deletes')) }}')">
                                {{__('apps::dashboard.datatable.delete_all_btn')}}
                            </button>
                        </div>
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
              url   : "{{ url(route('dashboard.labels.datatable')) }}",
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
            {data: 'id' 		 	    , className: 'dt-center'},
  			{data: 'id' 		 	    , className: 'dt-center'},
  			{data: 'title' 			    , className: 'dt-center'},
            {data: 'color' 	        , className: 'dt-center'},
            {data: 'created_at' 		, className: 'dt-center'},
            {data: 'id',responsivePriority: 1},
      		],
          columnDefs: [
            {
      				targets: 0,
      				width: '30px',
      				className: 'dt-center',
      				orderable: false,
      				render: function(data, type, full, meta) {
      					return `<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                          <input type="checkbox" value="`+data+`" class="group-checkable" name="ids">
                          <span></span>
                        </label>
                      `;
      				},
      			},
            {
              targets: -1,
              width: '13%',
              title: '{{__('catalog::dashboard.labels.datatable.options')}}',
              className: 'dt-center',
              orderable: false,
              render: function(data, type, full, meta) {

                // Edit
      					var editUrl = '{{ route("dashboard.labels.edit", ":id") }}';
      					editUrl = editUrl.replace(':id', data);

      					// Delete
      					var deleteUrl = '{{ route("dashboard.labels.destroy", ":id") }}';
      					deleteUrl = deleteUrl.replace(':id', data);

      					return `
                        @can('edit_labels')
      						<a href="`+editUrl+`" class="btn btn-sm blue" title="Edit">
      			              <i class="fa fa-edit"></i>
      			            </a>

                        @endcan

                            @can('delete_labels')
                            <a href="javascript:;" onclick="deleteRow('`+deleteUrl+`')" class="btn btn-sm red">
                                <i class="fa fa-trash"></i>
                            </a>

                        @endcan
                            `;
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
                  stripHtml: true,
                  columns: ':visible'
              }
  					},
  					{
  						extend: "print",
              className: "btn blue btn-outline" ,
              text: "{{__('apps::dashboard.datatable.print')}}",
              exportOptions: {
                  stripHtml: true,
                  columns: ':visible'
              }
  					},
  					{
  							extend: "pdf",
                className: "btn blue btn-outline" ,
                text: "{{__('apps::dashboard.datatable.pdf')}}",
                exportOptions: {
                    stripHtml: true,
                    columns: ':visible'
                }
  					},
  					{
  							extend: "excel",
                className: "btn blue btn-outline " ,
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
  				]
      });
  }

  jQuery(document).ready(function() {
  	tableGenerate();
  });
  </script>

@stop
