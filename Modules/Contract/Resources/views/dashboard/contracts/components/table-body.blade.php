{{-- DATATABLE CONTENT --}}
<div class="portlet-body">
    <table class="table table-striped table-bordered table-hover"
           id="dataTable" style="width: 0px !important;">
        <thead>
        <tr>
            <th>
                <a href="javascript:;" onclick="CheckAll()">
                    {{__('apps::dashboard.buttons.select_all')}}
                </a>
            </th>
            <th class="text-center">#</th>
            <th class="text-center">{{__('contract::dashboard.contracts.datatable.created_by')}}</th>
            <th class="text-center">{{__('contract::dashboard.contracts.datatable.client')}}</th>
            
            @can('show_contract_amount')
                <th class="text-center">{{__('contract::dashboard.contracts.datatable.price')}}</th>
            @endcan

            @can('show_contract_down_payment')
                <th class="text-center">{{__('contract::dashboard.contracts.datatable.down_payment')}}</th>
            @endcan

            <th class="text-center">{{__('contract::dashboard.contracts.datatable.remaining')}}</th>
            <th class="text-center">{{__('contract::dashboard.contracts.datatable.installment_with_fees')}}</th>
            <th class="text-center">{{__('contract::dashboard.contracts.datatable.overdue_amounts')}}</th>

            @can('show_installment_fees')
                <th class="text-center">{{__('contract::dashboard.contracts.datatable.installment_fees')}}</th>
            @endcan

            <th class="text-center">{{__('contract::dashboard.contracts.datatable.months_num')}}</th>
            <th class="text-center">{{__('contract::dashboard.contracts.datatable.installment_value')}}</th>

            @can('show_contract_paid_amount')
                <th class="text-center">{{__('contract::dashboard.contracts.datatable.paid')}}</th>
            @endcan

            @can('show_contract_profit')
                <th class="text-center">{{__('contract::dashboard.contracts.datatable.profit')}}</th>
            @endcan

            <th class="text-center">{{__('contract::dashboard.contracts.datatable.completed_at')}}</th>
            <th class="text-center">{{__('contract::dashboard.contracts.datatable.created_at')}}</th>
            <th class="text-center">{{__('contract::dashboard.contracts.datatable.options')}}</th>
        </tr>
        </thead>
    </table>
</div>
<div class="row">
    <div class="form-group">
        <button type="submit" id="deleteChecked" class="btn red btn-sm"
                onclick="deleteAllChecked('{{ url(route('dashboard.contracts.deletes')) }}')">
            {{__('apps::dashboard.datatable.delete_all_btn')}}
        </button>
    </div>
</div>