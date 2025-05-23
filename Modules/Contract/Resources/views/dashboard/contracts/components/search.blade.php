
                        {{-- DATATABLE FILTER --}}
                        <div class="row">
                            <div class="portlet box grey-cascade">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>
                                        {{__('apps::dashboard.datatable.search')}}
                                    </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div id="filter_data_table">
                                        <div class="panel-body">
                                            <form id="formFilter" class="horizontal-form">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    {{__('apps::dashboard.datatable.form.date_range')}}
                                                                </label>
                                                                <div id="reportrange" class="btn default form-control">
                                                                    <i class="fa fa-calendar"></i> &nbsp;
                                                                    <span> </span>
                                                                    <b class="fa fa-angle-down"></b>
                                                                    <input type="hidden" name="from">
                                                                    <input type="hidden" name="to">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            @include('user::dashboard.clients.components.select-search.index')
                                                            <br>
                                                        </div>
                                                        @can("filter_contract_with_created_employee")
                                                            <div class="col-md-3">
                                                                @inject('users','Modules\User\Entities\User')
                                                                {!! field('dashboard_login')->select('paid_by',__('installment::dashboard.installments.filters.paid_by'),
                                                                $users->pluck('name','id')->toArray())!!}
                                                            </div>
                                                        @endcan
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">
                                                                    {{__('apps::dashboard.datatable.form.soft_deleted')}}
                                                                </label>
                                                                <div class="mt-radio-list">
                                                                    <label class="mt-radio">
                                                                        {{__('apps::dashboard.datatable.form.delete_only')}}
                                                                        <input type="radio" value="only"
                                                                               name="deleted"/>
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="clearfix"></div>
                                                        <div class="col-md-6">

                                                            <label class="control-label">
                                                                {{__('contract::dashboard.contracts.filters.status')}}
                                                            </label>

                                                            <div class="form-group">

                                                                <label class="control-label"
                                                                       style="    margin-right: 9px;">
                                                                    {{__('contract::dashboard.contracts.filters.late_contract')}}
                                                                </label>
                                                                <input type="radio" name="complete_status" value="late" {{request('complete_status') == 'late'? 'checked':''}}>

                                                                <label class="control-label"
                                                                       style="    margin-right: 9px;">
                                                                    {{__('contract::dashboard.contracts.filters.completed_contract')}}
                                                                </label>
                                                                <input type="radio" name="complete_status"
                                                                       value="completed" {{request('complete_status') == 'completed'? 'checked':''}}>
                                                                <br>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="form-actions">
                                                <button class="btn btn-sm green btn-outline filter-submit margin-bottom"
                                                        id="search">
                                                    <i class="fa fa-search"></i>
                                                    {{__('apps::dashboard.datatable.search')}}
                                                </button>
                                                <button class="btn btn-sm red btn-outline filter-cancel">
                                                    <i class="fa fa-times"></i>
                                                    {{__('apps::dashboard.datatable.reset')}}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- END DATATABLE FILTER --}}