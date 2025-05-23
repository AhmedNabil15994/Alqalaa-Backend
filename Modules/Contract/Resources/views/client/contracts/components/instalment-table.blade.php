<div class="table-scrollable">
    <table class="table table-striped table-bordered table-advance table-hover">
        <thead>
        <th>#</th>
        <th class="text-center">{{__('contract::client.contracts.show.info.instalments_details.asked_amount')}}</th>
        <th class="text-center">{{__('contract::client.contracts.show.info.instalments_details.paid_amount')}}</th>
        <th class="text-center">{{__('contract::client.contracts.show.info.instalments_details.remaining_amount')}}</th>
        <th class="text-center">{{__('contract::client.contracts.show.info.instalments_details.due_date')}}</th>
        <th class="text-center">{{__('contract::client.contracts.show.info.instalments_details.transaction_date')}}</th>
        <th class="text-center">{{__('contract::client.contracts.show.info.instalments_details.status')}}</th>
        <th class="text-center">{{__('contract::client.contracts.show.info.instalments_details.details')}}</th>


        @if(auth('client')->user()->is_judging == 0)
            <th class="text-center">{{__('contract::client.contracts.show.info.instalments_details.pay')}} </th>
        @endif
        </thead>
        <tbody>
        @php $count = 1; @endphp
        @foreach($model->installments as $record)
            <tr id="removable{{$record->id}}">
                <td>
                    {{$count}}
                </td>
                <td class="text-center">{{$record->amount}}</td>
                <td class="text-center">{{$record->paid}}</td>
                <td class="text-center">{{$record->remaining}}</td>
                <td class="text-center">{{$record->due_date}}</td>
                <td class="text-center">
                    {{optional($record)->transaction_date}}
                </td>

                <td class="text-center">
                    @switch($record->status)

                        @case('not_complete')
                        <label class="label label-warning">{{__('installment::client.installments.datatable.not_complete')}}</label>
                        @break

                        @case('completed')
                        <label class="label label-success">{{__('installment::client.installments.datatable.completed')}}</label>
                        @break

                        @case('waiting')
                        <label class="label label-danger">{{__('installment::client.installments.datatable.waiting')}}</label>
                        @break

                    @endswitch
                </td>


                <td class="text-center">

                    <a class="btn-icon" data-toggle="modal"
                       data-target="#client{{$record->id}}">
                        <i class="btn btn-xs btn-info fa fa-eye"
                           style="padding: 4px 6px"></i>
                    </a>

                    <div class="modal fade"
                         id="client{{$record->id}}"
                         tabindex="-1"
                         role="dialog"
                         aria-labelledby="myModalLabel">

                        <div class="modal-dialog"
                             role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button"
                                            class="close"
                                            data-dismiss="modal"
                                            aria-label="Close"><span
                                                aria-hidden="true">&times;</span>
                                    </button>

                                    @switch($record->status)



                                        @case('not_complete')
                                        <label class="label label-danger">
                                            {{__('contract::client.contracts.show.info.instalments_details.not_complete')}}
                                        </label>
                                        @break

                                        @case('completed')
                                        <label class="label label-success">
                                            {{__('contract::client.contracts.show.info.instalments_details.completed')}}
                                        </label>
                                        @break

                                        @case('waiting')
                                        <label class="label label-warning">
                                            {{__('contract::client.contracts.show.info.instalments_details.waiting')}}
                                        </label>
                                        @break

                                    @endswitch
                                </div>
                                <div class="modal-body">

                                    <p><strong>
                                            {{__('contract::client.contracts.show.info.instalments_details.asked_amount')}}
                                            : </strong> {{$record->amount}}
                                    </p>
                                    <p><strong>
                                            {{__('contract::client.contracts.show.info.instalments_details.paid_amount')}}
                                            : </strong> {{$record->paid}}
                                    </p>
                                    <p><strong>
                                            {{__('contract::client.contracts.show.info.instalments_details.remaining_amount')}}
                                            : </strong> {{$record->remaining}}
                                    </p>
                                    <p><strong>
                                            {{__('contract::client.contracts.show.info.instalments_details.due_date')}}
                                            : </strong> {{$record->due_date}}
                                    </p>
                                    <p><strong>
                                            {{__('contract::client.contracts.show.info.instalments_details.transaction_date')}}
                                            : </strong>
                                        {{optional($record)->transaction_date}}
                                    </p>
                                    <p style="    background-color: #5555551f;border-radius: 3px;padding: 13px 7px;">
                                        <strong>
                                            {{__('contract::client.contracts.show.info.instalments_details.note')}}
                                            : </strong>
                                        <span>{{$record->note}}</span>
                                    </p>
                                    <br>

                                    @if($record->payments()->count())

                                        <p><strong>
                                                {{__('contract::client.contracts.show.info.instalments_details.old_paid_amount')}}
                                                : </strong></p>
                                        <table class="data-table table table-bordered">
                                            <thead>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th class="text-center">
                                                {{__('contract::client.contracts.show.info.instalments_details.paid_amount')}}
                                            </th>
                                            <th class="text-center">
                                                {{__('contract::client.contracts.show.info.instalments_details.transaction_date')}}
                                            </th>
                                            <th class="text-center">
                                                {{__('contract::client.contracts.show.info.instalments_details.note')}}
                                            </th>
                                            </thead>
                                            <tbody>
                                            @foreach($record->payments as $transaction)

                                                <tr>
                                                    <td>
                                                        {{$loop->iteration}}
                                                    </td>
                                                    <td>
                                                        {{$transaction->amount}}
                                                    </td>
                                                    <td>
                                                        {{$transaction->transaction_date}}
                                                    </td>
                                                    <td>
                                                        {{$transaction->note}}
                                                    </td>
                                                </tr>

                                            @endforeach

                                            </tbody>
                                        </table>
                                    @endif

                                    <br>
                                </div>
                                <div class="modal-footer">
                                    <button type="button"
                                            class="btn btn-default"
                                            data-dismiss="modal"
                                            style="background-color: #00c0ef;color: white">
                                        {{__('contract::client.contracts.show.btn.cancel')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>

                @if(auth('client')->user()->is_judging == 0)
                    <td class="text-center">
                        @if($record->transaction_date == null)
                            @if($record->valid_to_pay)
                                <a href="#"
                                   onclick="openPayModel({{$record}})"
                                   class="btn btn-primary">
                                    {{__('contract::client.contracts.show.btn.pay_installment')}}
                                </a>
                            @else
                                <a class="btn btn-warning">
                                    {{__('contract::client.contracts.show.btn.closed_to_pay')}}
                                </a>

                            @endif
                        @else
                            <a
                                    href="{{url(route('client.installments.print' , $record->id))}}"
                                    class="btn btn-success">
                                {{__('contract::client.contracts.show.btn.paid')}}
                            </a>

                        @endif
                    </td>
                @endif
            </tr>
            @php $count ++; @endphp
        @endforeach
        </tbody>
    </table>
</div>