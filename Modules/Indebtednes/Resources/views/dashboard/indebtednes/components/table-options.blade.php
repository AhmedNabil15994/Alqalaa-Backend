@if(request('client_id'))
    @can('show_indebtednes')
        <a href="{{ route("dashboard.indebtednes.show", $model->id) }}" class="btn btn-xs btn-success" title="Show">
            <i class="fa fa-eye"></i>
        </a>
    @endcan
@endif

@can('edit_indebtednes')
    <a href="{{ route("dashboard.indebtednes.edit", $model->id) }}" class="btn btn-xs blue" title="Edit">
        <i class="fa fa-edit"></i>
    </a>
@endcan

@can('edit_indebtednes')
    @csrf
    <a href="javascript:;" onclick="deleteRow('{{ route("dashboard.indebtednes.destroy", $model->id) }}')"
       class="btn btn-xs red">
        <i class="fa fa-trash"></i>
    </a>
@endcan