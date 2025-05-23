@extends('apps::dashboard.layouts.app')
@section('title', __('contract::dashboard.contracts.routes.create'))
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
                        <a href="{{ url(route('dashboard.contracts.index')) }}">
                            {{__('contract::dashboard.contracts.routes.index')}}
                        </a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="#">{{__('contract::dashboard.contracts.routes.create')}}</a>
                    </li>
                </ul>
            </div>

            <h1 class="page-title"></h1>

            <div class="row">
                {!! Form::model($model,[
                                'url'=> route('dashboard.contracts.store'),
                                'id'=>'form',
                                'role'=>'form',
                                'method'=>'POST',
                                'class'=>'form-horizontal form-row-seperated',
                                'files' => true
                                ])!!}
                <div class="col-md-6 ">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-red-sunglo">
                                <i class="icon-settings font-red-sunglo"></i>
                                <span class="caption-subject bold uppercase">{{__('contract::dashboard.contracts.form.contract')}}</span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                                <div class="form-body">
                                    @include('contract::dashboard.contracts.form.index')
                                </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 ">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-red-sunglo">
                                <i class="icon-settings font-red-sunglo"></i>
                                <span class="caption-subject bold uppercase">{{__('contract::dashboard.contracts.form.client_id')}}</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2">
                            </label>

                            <div class="col-md-9">
                                <div class="md-radio-inline">
                                    <label class="mt-radio">
                                        <input type="radio" name="client_type" id="type" value="chose"
                                               checked="checked">
                                        {{__('contract::dashboard.contracts.form.chose_client')}}
                                        <span></span>
                                    </label>
                                    <label class="mt-radio">
                                        <input type="radio" name="client_type" id="type" value="create">
                                        {{__('contract::dashboard.contracts.form.create_client')}}
                                        <span></span>
                                    </label>

                                </div>
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="portlet-body form">
                                <div class="form-body">
                                    @include('contract::dashboard.contracts.form.clients')
                                </div>
                        </div>
                    </div>
                    
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12" style="margin-right: 12px; margin-left: 12px; margin-bottom: 12px;">
                    <div class="col-md-12">
                    @include('contract::dashboard.contracts.form.details')
                    </div>
                </div>
                <br>
                <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="form-actions">
                            @include('apps::dashboard.layouts._ajax-msg')
                            <div class="form-group">
                                <button type="submit" id="submit" class="btn btn-lg blue">
                                    {{__('apps::dashboard.buttons.add')}}
                                </button>
                                <a href="{{url(route('dashboard.contracts.index')) }}" class="btn btn-lg red">
                                    {{__('apps::dashboard.buttons.back')}}
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

                {!! Form::close()!!}
            </div>
        </div>
    </div>
    
@stop


@section('scripts')

@endsection