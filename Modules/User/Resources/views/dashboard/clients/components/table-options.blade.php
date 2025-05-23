<div class="btn-group">
    <a class="btn btn-success btn-sm" href="javascript:;" data-toggle="dropdown">
        <i class="fa fa-lg fa-cogs"></i>
        <i class="fa fa-angle-down"></i>
    </a>
    <ul class="dropdown-menu pull-right">
        @can('show_devices')
            <li>
                <a href="{{url(route('dashboard.devices.index').'?client='.$model->id)}}">
                    <i class="fa fa-mobile"></i> {{__('user::dashboard.clients.actions.devices')}}
                </a>
            </li>
        @endcan
        @can('show_case_actions')
            <li>
                <a href="{{ url(route("dashboard.case-actions.index").'?client_id='.$model->id) }}">
                    <i class="fa fa-balance-scale"></i> {{__('user::dashboard.clients.actions.case_action')}}
                </a>
            </li>
        @endcan

{{--        @can('show_clients')--}}
{{--            <li>--}}
{{--                <a href="{{ route("dashboard.clients.show", $model->id) }}">--}}
{{--                    <i class="fa fa-eye"></i> {{__('user::dashboard.clients.actions.show')}}--}}
{{--                </a>--}}
{{--            </li>--}}
{{--        @endcan--}}

        @can('edit_clients')
            <li>
                <a href="{{ route("dashboard.clients.edit", $model->id) }}">
                    <i class="fa fa-pencil"></i> {{__('user::dashboard.clients.actions.update')}}
                </a>
            </li>
        @endcan
        @can('delete_clients')
            <li>
                <a href="javascript:;" onclick="deleteRow('{{ route("dashboard.areas.destroy", $model->id)}}')">
                    <i class="fa fa-trash-o"></i> {{__('user::dashboard.clients.actions.delete')}} </a>
            </li>
        @endcan
    </ul>
</div>