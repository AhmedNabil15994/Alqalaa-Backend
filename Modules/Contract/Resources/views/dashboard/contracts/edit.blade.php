@extends('apps::dashboard.layouts.app')
@section('title', __('contract::dashboard.contracts.routes.update'))
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
                    <a href="#">{{__('contract::dashboard.contracts.routes.update')}}</a>
                </li>
            </ul>
        </div>

        <h1 class="page-title"></h1>

        <div class="row">
            {!! Form::model($model,[
                          'url'=> route('dashboard.contracts.update',$model->id),
                          'id'=>'updateForm',
                          'role'=>'form',
                          'page'=>'form',
                          'class'=>'form-horizontal form-row-seperated',
                          'method'=>'PUT',
                          'files' => true
                          ])!!}

                <div class="col-md-12">

                    @include('contract::dashboard.contracts.form.form-panel-body')

                    <div class="col-md-9">
                        <div class="tab-content">
                            @inject('clients','Modules\User\Entities\Client')
                            {!! field()->select('client_id', __('contract::dashboard.contracts.form.client_id'),$clients->all()->pluck('selector_name','id')->toArray()) !!}
                            @include('contract::dashboard.contracts.form.index')
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-right: 12px; margin-left: 12px; margin-bottom: 12px;">
                        <div class="col-md-12">
                        @include('contract::dashboard.contracts.form.details')
                        </div>
                    </div>
                    {{-- PAGE ACTION --}}
                    <div class="col-md-12">
                        <div class="form-actions">
                            @include('apps::dashboard.layouts._ajax-msg')
                            <div class="form-group">
                                <button type="submit" id="submit" class="btn btn-lg green">
                                    {{__('apps::dashboard.buttons.edit')}}
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
