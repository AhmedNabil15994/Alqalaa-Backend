@extends('apps::dashboard.layouts.app')
@section('title', __('indebtednes::dashboard.indebtednes.routes.update'))
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
                    <a href="{{ url(route('dashboard.indebtednes.index')) }}">
                        {{__('indebtednes::dashboard.indebtednes.routes.index')}}
                    </a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="#">{{__('indebtednes::dashboard.indebtednes.routes.update')}}</a>
                </li>
            </ul>
        </div>

        <h1 class="page-title"></h1>

        <div class="row">
            {!! Form::model($model,[
                          'url'=> route('dashboard.indebtednes.update',$model->id),
                          'id'=>'updateForm',
                          'role'=>'form',
                          'page'=>'form',
                          'class'=>'form-horizontal form-row-seperated',
                          'method'=>'PUT',
                          'files' => true
                          ])!!}

                <div class="col-md-12">

                    @include('indebtednes::dashboard.indebtednes.form.form-panel-body')

                    <div class="col-md-9">
                        <div class="tab-content">
                            @inject('clients','Modules\User\Entities\Client')
                            {!! field()->select('client_id', __('indebtednes::dashboard.indebtednes.form.client_id'),$clients->all()->pluck('selector_name','id')->toArray()) !!}
                            @include('indebtednes::dashboard.indebtednes.form.index')
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
                                <a href="{{url(route('dashboard.indebtednes.index')) }}" class="btn btn-lg red">
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
