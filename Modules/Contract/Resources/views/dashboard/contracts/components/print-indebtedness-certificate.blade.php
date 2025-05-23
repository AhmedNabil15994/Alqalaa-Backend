@extends('apps::dashboard.layouts.print-invoice')
@section('title' , __('contract::dashboard.contracts.form.contract_installment'))
@push('styles')
    <style media="screen,print">
        table{
            padding: 10px 5px;
            width: 100%;
            background-color: #ddd;
            margin-top: 15px;
            margin-bottom: 50px;
        }
        table th{
            border: 1px solid #000;
            padding: 10px;
        }
    </style>
@endpush
@section('content')
    <!-- begin invoice-header -->

    <div class="row">
        <div class="col-xs-6">
            <h6 style="margin-bottom: 15px">{{ __('contract::dashboard.contracts.form.ministry_of_justice')}}</h6>
            <h6 style="margin-bottom: 15px">{{ __('contract::dashboard.contracts.form.doc_manage')}}</h6>
            <h6 style="margin-bottom: 15px"> {{ __('contract::dashboard.contracts.form.date')}} : {{date('Y/m/d',strtotime($model->created_at))}}</h6>
        </div>
    </div>

    <div class="text-{{locale() == 'ar' ? 'right' : 'left'}}">
        <center>
            <h2 style="margin-bottom: 35px;">{{ __('contract::dashboard.contracts.form.indebtedness_certificate')}}</h2>
        </center>

        <b>  {{ __('contract::dashboard.contracts.form.witness')}}  &nbsp; &nbsp; &nbsp; {{ setting('app_name',locale()) }}  </b>  &nbsp; &nbsp; {{ __('contract::dashboard.contracts.form.that')}} :

        <table>
            <thead>
            <tr>
                <th width="30%">{{__('contract::dashboard.contracts.form.mr')}}</th>
                <th>{{optional($model->client)->getTranslation('name',locale())}}</th>
            </tr>
            <tr>
                <th width="30%">{{__('contract::dashboard.contracts.show.info.client.national_ID')}}</th>
                <th>{{optional($model->client)->national_ID}}</th>
            </tr>
            </thead>
        </table>

        <p>{{ __('contract::dashboard.contracts.form.he_owes')}} : </p>
        <table>
            <thead>
            <tr>
                <th width="30%">{{__('contract::dashboard.contracts.form.total_indebtedness')}}</th>
                <th>{{number_format(($model->installment_with_fees  + setting('contract','lawyer_cost')),2)}} {{__('contract::dashboard.contracts.form.kd')}}</th>
            </tr>
            <tr>
                <th width="30%">{{__('contract::dashboard.contracts.form.monthly_installment')}}</th>
                <th>{{number_format($model->installment_with_fees / $model->months_num,2)}} {{__('contract::dashboard.contracts.form.kd')}}</th>
            </tr>
            <tr>
                <th width="30%">{{__('contract::dashboard.contracts.form.first_monthly_installment')}}</th>
                <th>{{date('Y/m/d',strtotime($model->installments()->orderBy('due_date','asc')->first()?->due_date))}}</th>
            </tr>
            </thead>
        </table>

        <p class="notes">{{ __('contract::dashboard.contracts.form.indebtedness_certificate_notes')}}</p>

        <div class="row" style="margin-top: 35px">
            <div class="col-8"></div>
            <div class="col-4 text-center">
                <p>{{ setting('app_name',locale()) }} </p>
                <p>{{ __('contract::dashboard.contracts.form.institution_seal')}}</p>
            </div>
        </div>
    </div>
@stop
