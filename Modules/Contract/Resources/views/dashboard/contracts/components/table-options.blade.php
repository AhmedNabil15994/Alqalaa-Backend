@can('show_contracts')
    @if(!$model->is_pending_for_review)
        <a href="{{ route("dashboard.contracts.show", $model->id) }}" class="btn btn-xs btn-success" title="Show">
            <i class="fa fa-eye"></i>
        </a>
    @endif
@endcan
@can('edit_contracts')
    @if($model->is_valid_to_edit)
        <a href="{{ route("dashboard.contracts.edit", $model->id) }}" class="btn btn-xs blue" title="Edit">
            <i class="fa fa-edit"></i>
        </a>
    @endif
@endcan
@can('delete_contracts')
    @csrf
    <a href="javascript:;" onclick="deleteRow('{{ route("dashboard.contracts.destroy", $model->id) }}')"
       class="btn btn-xs red">
        <i class="fa fa-trash"></i>
    </a>
@endcan