<div class="page-sidebar-wrapper">

    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed"
            data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">

            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <li class="nav-item {{ active_menu('home') }}">
                <a href="{{ url(route('dashboard.home')) }}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">{{ __('apps::dashboard.index.title') }}</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="heading">
                <h3 class="uppercase">{{ __('apps::dashboard._layout.aside._tabs.control') }}</h3>
            </li>

            @can('show_clients')

                <li class="nav-item  {{active_slide_menu(['clients','roles','admins'])}}">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-users"></i>
                        <span class="title">{{ __('apps::dashboard._layout.aside.users') }}</span>
                        <span class="arrow {{active_slide_menu(['clients','roles','admins'])}}"></span>
                        <span class="selected"></span>
                    </a>
                    <ul class="sub-menu">

                        @can('show_roles')
                            <li class="nav-item {{ active_menu('roles') }}">
                                <a href="{{ url(route('dashboard.roles.index')) }}" class="nav-link nav-toggle">
                                    <i class="icon-briefcase"></i>
                                    <span class="title">{{ __('apps::dashboard._layout.aside.roles') }}</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                        @endcan

                        @can('show_admins')
                            <li class="nav-item {{ active_menu('admins') }}">
                                <a href="{{ url(route('dashboard.admins.index')) }}" class="nav-link nav-toggle">
                                    <i class="icon-user"></i>
                                    <span class="title">{{ __('apps::dashboard._layout.aside.admins') }}</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                        @endcan

                        <li class="nav-item {{ active_menu('clients') == 'active' && !request('is_judging') ? 'active' : '' }}">
                            <a href="{{ url(route('dashboard.clients.index')) }}" class="nav-link nav-toggle">
                                <i class="icon-users"></i>
                                <span class="title">{{ __('apps::dashboard._layout.aside.clients') }}</span>
                                <span class="selected"></span>
                            </a>
                        </li>
                        <li class="nav-item {{ active_menu('clients') == 'active' && request('is_judging') ? 'active' : '' }}">
                            <a href="{{ url(route('dashboard.clients.index').'?is_judging=1') }}"
                               class="nav-link nav-toggle">
                                <i class="fa fa-balance-scale"></i>
                                <span class="title">{{ __('apps::dashboard._layout.aside.referred_to_court') }}</span>
                                <span class="selected"></span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan

            @can('show_notifications')
                <li class="nav-item {{ active_menu('month-percentages') }}">
                    <a href="{{ url(route('dashboard.month-percentages.index')) }}" class="nav-link nav-toggle">
                        <i class="fa fa-calendar-plus-o"></i>
                        <span class="title">{{ __('apps::dashboard._layout.aside.month-percentages') }}</span>
                        <span class="selected"></span>
                    </a>
                </li>
            @endcan

            @can('show_contract_status')
                <li class="nav-item {{ active_menu('contract-status') }}">
                    <a href="{{ url(route('dashboard.contract-status.index')) }}" class="nav-link nav-toggle">
                        <i class="icon-paper-clip"></i>
                        <span class="title">{{ __('apps::dashboard._layout.aside.contract_status') }}</span>
                        <span class="selected"></span>
                    </a>
                </li>
            @endcan

            @can('manage_types')
                <li class="nav-item {{ active_menu('contract-types') }}">
                    <a href="{{ url(route('dashboard.contract-types.index')) }}" class="nav-link nav-toggle">
                        <i class="icon-paper-clip"></i>
                        <span class="title">{{ __('apps::dashboard._layout.aside.contract_types') }}</span>
                        <span class="selected"></span>
                    </a>
                </li>
            @endcan

            @can('show_contracts')

                <li class="nav-item  {{active_slide_menu(['contracts','completed-contracts'])}}">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-paper-clip"></i>
                        <span class="title">{{ __('apps::dashboard._layout.aside.contracts') }}</span>
                        <span class="arrow {{active_slide_menu(['contracts'])}}"></span>
                        <span class="selected"></span>
                    </a>
                    <ul class="sub-menu">
                        
                        <li class="nav-item {{ active_menu('pending-contracts') }}">
                            <a href="{{ url(route('dashboard.pending-contracts.index')) }}" class="nav-link nav-toggle">
                                <span class="title">{{ __('apps::dashboard._layout.aside.contracts_under_review') }}</span>
                                <span class="selected"></span>
                            </a>
                        </li>
                        
                        <li class="nav-item {{ active_menu('current-contracts') }}">
                            <a href="{{ url(route('dashboard.current-contracts.index')) }}" class="nav-link nav-toggle">
                                <span class="title">{{ __('apps::dashboard._layout.aside.current_contracts') }}</span>
                                <span class="selected"></span>
                            </a>
                        </li>
                        
                        <li class="nav-item {{ active_menu('completed-contracts') }}">
                            <a href="{{ url(route('dashboard.completed-contracts.index')) }}" class="nav-link nav-toggle">
                                <span class="title">{{ __('apps::dashboard._layout.aside.completed_contracts') }}</span>
                                <span class="selected"></span>
                            </a>
                        </li>
                        
                        <li class="nav-item {{ active_menu('contracts') }}">
                            <a href="{{ url(route('dashboard.contracts.index')) }}" class="nav-link nav-toggle">
                                <span class="title">{{ __('apps::dashboard._layout.aside.all_contracts') }}</span>
                                <span class="selected"></span>
                            </a>
                        </li>
                    </ul>
                </li>

            @endcan

            @can('show_installments')

                <li class="heading">
                    <h3 class="uppercase">{{ __('apps::dashboard._layout.aside.installments') }}</h3>
                </li>

                <li class="nav-item {{ !empty($datatableRoute) && $datatableRoute == 'dashboard.installments.datatable' ? 'active' : '' }}">
                    <a href="{{ url(route('dashboard.installments.index')) }}" class="nav-link nav-toggle">
                        <i class="fa fa-money"></i>
                        <span class="title">{{ __('apps::dashboard._layout.aside.installments') }}</span>
                        <span class="selected"></span>
                    </a>
                </li>
                <li class="nav-item {{ !empty($datatableRoute) && $datatableRoute == 'dashboard.installments.judging.datatable' ? 'active' : '' }}">
                    <a href="{{ url(route('dashboard.installments.judging.index')) }}" class="nav-link nav-toggle">
                        <i class="fa fa-money"></i>
                        <span class="title">{{ __('apps::dashboard._layout.aside.judging_installments') }}</span>
                        <span class="selected"></span>
                    </a>
                </li>
            @endcan

            @can('show_instalments_payments_reports')


                <li class="nav-item {{ active_menu('dashboard.installments.installments.payments') }}">
                    <a href="{{ url(route('dashboard.installments.payments.index')) }}" class="nav-link nav-toggle">
                        <i class="fa fa-share"></i>
                        <span class="title">{{ __('apps::dashboard._layout.aside.installments_payments') }}</span>
                        <span class="selected"></span>
                    </a>
                </li>
            @endcan

            @can('show_case_actions')
                <li class="nav-item {{ active_menu('case-actions') }}">
                    <a href="{{ url(route('dashboard.case-actions.index')) }}" class="nav-link nav-toggle">
                        <i class="fa fa-balance-scale"></i>
                        <span class="title">{{ __('apps::dashboard._layout.aside.case-actions') }}</span>
                        <span class="selected"></span>
                    </a>
                </li>
            @endcan

            @can('show_indebtednes')

                <li class="heading">
                    <h3 class="uppercase">{{ __('apps::dashboard._layout.aside.indebtednes') }}</h3>
                </li>

                <li class="nav-item {{ active_menu('indebtednes') }}">
                    <a href="{{ url(route('dashboard.indebtednes.index')) }}" class="nav-link nav-toggle">
                        <i class="fa fa-share"></i>
                        <span class="title">{{ __('apps::dashboard._layout.aside.indebtednes') }}</span>
                        <span class="selected"></span>
                    </a>
                </li>
            @endcan

            @canany(['show_countries','show_areas','show_cities','show_states','edit_nationalities','edit_settings','show_logs','show_logs','show_telescope'])
                <li class="heading">
                    <h3 class="uppercase">{{ __('apps::dashboard._layout.aside._tabs.other') }}</h3>
                </li>

                @canany(['show_countries','show_areas','show_cities','show_states'])
                    <li class="nav-item  {{active_slide_menu(['countries','cities','states','areas'])}}">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="icon-pointer"></i>
                            <span class="title">{{ __('apps::dashboard._layout.aside.countries') }}</span>
                            <span class="arrow {{active_slide_menu(['countries','governorates','cities','regions'])}}"></span>
                            <span class="selected"></span>
                        </a>
                        <ul class="sub-menu">

                            @can('show_countries')
                                <li class="nav-item {{ active_menu('countries') }}">
                                    <a href="{{ url(route('dashboard.countries.index')) }}" class="nav-link nav-toggle">
                                        <i class="fa fa-building"></i>
                                        <span class="title">{{ __('apps::dashboard._layout.aside.countries') }}</span>
                                        <span class="selected"></span>
                                    </a>
                                </li>
                            @endcan

                            @can('show_cities')
                                <li class="nav-item {{ active_menu('cities') }}">
                                    <a href="{{ url(route('dashboard.cities.index')) }}" class="nav-link nav-toggle">
                                        <i class="fa fa-building"></i>
                                        <span class="title">{{ __('apps::dashboard._layout.aside.cities') }}</span>
                                        <span class="selected"></span>
                                    </a>
                                </li>
                            @endcan

                            @can('show_states')
                                <li class="nav-item {{ active_menu('states') }}">
                                    <a href="{{ url(route('dashboard.states.index')) }}" class="nav-link nav-toggle">
                                        <i class="fa fa-building"></i>
                                        <span class="title">{{ __('apps::dashboard._layout.aside.state') }}</span>
                                        <span class="selected"></span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanAny

                @can('show_labels')
                    <li class="nav-item {{ active_menu('labels') }}">
                        <a href="{{ url(route('dashboard.labels.index')) }}" class="nav-link nav-toggle">
                            <i class="icon-folder"></i>
                            <span class="title">{{ __('Labels') }}</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                @endcan

                @can('edit_nationalities')
                    <li class="nav-item {{ active_menu('nationalities') }}">
                        <a href="{{ url(route('dashboard.nationalities.index')) }}" class="nav-link nav-toggle">
                            <i class="icon-folder"></i>
                            <span class="title">{{ __('apps::dashboard._layout.aside.nationalities') }}</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                @endcan

                @can('edit_settings')
                    <li class="nav-item {{ active_menu('setting') }}">
                        <a href="{{ url(route('dashboard.setting.index')) }}" class="nav-link nav-toggle">
                            <i class="icon-settings"></i>
                            <span class="title">{{ __('apps::dashboard._layout.aside.setting') }}</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                @endcan

                @can('show_logs')
                    <li class="nav-item {{ active_menu('logs') }}">
                        <a href="{{ url(route('dashboard.logs.index')) }}" class="nav-link nav-toggle">
                            <i class="icon-folder"></i>
                            <span class="title">{{ __('apps::dashboard._layout.aside.logs') }}</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                @endcan


                @can('show_logs')
                    <li class="nav-item {{ active_menu('devices') }}">
                        <a href="{{ url(route('dashboard.devices.index')) }}" class="nav-link nav-toggle">
                            <i class="fa fa-mobile"></i>
                            <span class="title">{{ __('apps::dashboard._layout.aside.devices') }}</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                @endcan

                @can('show_telescope')
                    <li class="nav-item {{ active_menu('telescope') }}">
                        <a href="{{ url(route('telescope')) }}" class="nav-link nav-toggle">
                            <i class="icon-settings"></i>
                            <span class="title">{{ __('apps::dashboard._layout.aside.telescope') }}</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                @endcan
            @endcanAny
        </ul>
    </div>

</div>
