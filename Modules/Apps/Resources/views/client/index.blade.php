@extends('apps::client.layouts.app')
@section('title', __('apps::client.index.title'))
@section('content')

    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{ url(route('client.home')) }}">
                            {{ __('apps::client.index.title') }}
                        </a>
                    </li>
                </ul>
            </div>
            <h1 class="page-title"> {{ __('apps::client.index.welcome') }} ,
                <small><b style="color:red">{{ auth('client')->user()->name }} </b></small>
            </h1>
        </div>
    </div>

@stop
