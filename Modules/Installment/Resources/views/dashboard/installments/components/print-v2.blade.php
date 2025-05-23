@extends('apps::dashboard.layouts.print-invoice-v2')
@section('title', __('installment::dashboard.installments.form.installment_invoice'))
@push('styles')

    <style>

        .installment-data-table{
            width: 100%;
        }
        .installment-data-table thead tr{
            background-color: #dddfe033;
        }
        .installment-data-table thead th{
            border: 1px solid #dddfe0e6;
            padding: 0px 7px 0px 0px;
        }
    </style>
@endpush
@section('content')

    <!-- begin invoice-header -->
    <div class="invoice-header" style="text-align: {{is_rtl() == 'rtl'?'right':'left'}}">
        <div class="invoice-from">
            <address class="m-t-5 m-b-5">
                <strong class="text-inverse">
                    @switch($model->status)
                        @case('not_complete')
                        {{__('contract::dashboard.contracts.show.info.instalments_details.not_complete')}}
                        @break

                        @case('completed')
                        {{__('contract::dashboard.contracts.show.info.instalments_details.completed')}}
                        @break

                        @case('waiting')
                        {{__('contract::dashboard.contracts.show.info.instalments_details.waiting')}}
                        @break
                    @endswitch
                </strong><br><br>
                <p><strong>
                        {{__('contract::dashboard.contracts.show.info.instalments_details.contract_id')}}
                        : </strong>
                    {{optional($model->contract)->contract_number}}
                </p>
                <p><strong>
                        {{__('contract::dashboard.contracts.show.info.instalments_details.client_name')}}
                        : </strong> {{optional(optional($model->contract)->client)->name}}
                </p>
                <p><strong>
                        {{__('contract::dashboard.contracts.show.info.instalments_details.asked_amount')}}
                        : </strong> {{$model->amount}}
                </p>
                <p><strong>
                        {{__('contract::dashboard.contracts.show.info.instalments_details.paid_amount')}}
                        : </strong> {{$model->paid}}
                </p>
                <p><strong>
                        {{__('contract::dashboard.contracts.show.info.instalments_details.remaining_amount')}}
                        : </strong> {{$model->remaining}}
                </p>
                <p><strong>
                        {{__('contract::dashboard.contracts.show.info.instalments_details.due_date')}}
                        : </strong> {{$model->due_date}}
                </p>
                <p><strong>
                        {{__('contract::dashboard.contracts.show.info.instalments_details.transaction_date')}}
                        : </strong>
                    @if(optional($model)->transaction_date)
                        {{optional($model)->transaction_date}}
                    @else
                        <label class="bage bage-danger">
                            {{__('contract::dashboard.contracts.show.info.instalments_details.not_complete')}}
                        </label>
                    @endif
                </p>
                <p style="    background-color: #5555551f;border-radius: 3px;padding: 13px 7px;">
                    <strong>
                        {{__('contract::dashboard.contracts.show.info.instalments_details.note')}}
                        : </strong>
                    <span>{{$model->note}}</span>
                </p>
            </address>
        </div>
        <div class="invoice-to">
            <small></small>
            <address class="m-t-5 m-b-5">
                <strong class="text-inverse"></strong><br>

            </address>
        </div>
    </div>
    <!-- end invoice-header -->

    <!-- begin invoice-content -->
    <div class="invoice-content"  style="text-align: {{is_rtl() == 'rtl'?'right':'left'}}">
        <!-- begin invoice-price -->
        @if($model->payments()->count())

            <p><strong>
                    {{__('contract::dashboard.contracts.show.info.instalments_details.old_paid_amount')}}
                    : </strong></p>
            <table class="installment-data-table table table-bordered">
                <thead>
                <th class="text-center">
                    #
                </th>
                <th class="text-center">
                    {{__('contract::dashboard.contracts.show.info.instalments_details.paid_amount')}}
                </th>
                <th class="text-center">
                    {{__('contract::dashboard.contracts.show.info.instalments_details.transaction_date')}}
                </th>
                <th class="text-center">
                    {{__('contract::dashboard.contracts.show.info.instalments_details.note')}}
                </th>
                </thead>
                <tbody>
                @foreach($model->payments as $transaction)

                    <tr>
                        <td class="text-center">
                            {{$loop->iteration}}
                        </td>
                        <td class="text-center">
                            {{$transaction->amount}}
                        </td>
                        <td class="text-center">
                            {{$transaction->transaction_date}}
                        </td>
                        <td class="text-center">
                            {{$transaction->note}}
                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>
    @endif
        <!-- end invoice-price -->
    </div>
    <!-- end invoice-content -->

@stop

