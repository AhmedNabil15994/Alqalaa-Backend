@extends('apps::dashboard.layouts.app')
@section('title', __('catalog::dashboard.notifications.routes.send'))
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
                        <a href="{{ url(route('dashboard.clients.index')) }}">
                            {{__('user::dashboard.clients.routes.index')}}
                        </a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="#">{{__('catalog::dashboard.notifications.routes.send')}}</a>
                    </li>
                </ul>
            </div>

            <h1 class="page-title"></h1>

            <div class="row">
                {!! Form::open([
                                'url'=> route('dashboard.clients.notification.send'),
                                'id'=>'form',
                                'role'=>'form',
                                'method'=>'POST',
                                'class'=>'form-horizontal form-row-seperated',
                                'files' => true
                                ])!!}

                <div class="col-md-12">

                    <div class="col-md-3">
                        <div class="panel-group accordion scrollable" id="accordion2">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a class="accordion-toggle"></a></h4>
                                </div>
                                <div id="collapse_2_1" class="panel-collapse in">
                                    <div class="panel-body">
                                        <ul class="nav nav-pills nav-stacked">
                                            <li class="active">
                                                <a href="#global_setting" data-toggle="tab">
                                                    {{ __('user::dashboard.clients.form.tabs.general') }}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane active fade in" id="global_setting">
                                <div class="col-md-10">
                                    @inject('clients','Modules\User\Entities\Client')

                                    {!! field()->multiSelect('clients', __('catalog::dashboard.notifications.form.clients') , $clients->get()->pluck('selector_name','id')->toArray(),
                                    request('client')?(array)request('client'): null) !!}
                                    {!! field()->text('title', __('catalog::dashboard.notifications.form.title')) !!}
                                    {!! field()->textarea('body', __('catalog::dashboard.notifications.form.body')) !!}
                                    {!! field()->file('image', __('catalog::dashboard.notifications.form.image')) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-actions">
                            @include('apps::dashboard.layouts._ajax-msg')
                            <div class="form-group">
                                <button type="submit" id="submit" class="btn btn-lg blue">
                                    {{__('apps::dashboard.buttons.send')}}
                                </button>
                                <a href="{{url(route('dashboard.clients.index')) }}" class="btn btn-lg red">
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