<div class="table-container" style="">
    @can('pay_indebtednes')
        @if($model->price > $model->total_paid)
            <div class="col-lg-1" style="margin: 3px 2px;">
                <div class="btn-group">
                    <button type="button" class="btn sbold green"
                            data-toggle="modal" data-target="#pay-installment">

                        <i class="fa fa-plus"></i>
                        {{__('indebtednes::dashboard.indebtednes.show.btn.pay_installment')}}
                    </button>
                </div>
            </div>

            <div class="modal fade bd-example-modal-lg"
                 id="pay-installment"
                 tabindex="-1"
                 role="dialog"
                 aria-labelledby="myLargeModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content animated bounceInRight">
                        <div class="modal-header">
                            <h4 class="modal-title">
                                {{__('indebtednes::dashboard.indebtednes.show.btn.pay_installment')}}
                            </h4>
                        </div>
                        <div class="modal-body">
                            {!! Form::model($model,[
                                'url' => url(route('dashboard.indebtednes.pay', $model->id)),
                                'id'=>'instalment-form',
                                'method' => 'put',
                            ]) !!}

                            <input type="hidden" name="indebtednes_id" value="{{$model->id}}">
                            {!! field()->number('' ,__('indebtednes::dashboard.indebtednes.show.info.instalments_details.indebtednes_id'), $model->indebt_number , ['readonly' => 'readonly']) !!}
                            {!! field()->number('amount' ,__('indebtednes::dashboard.indebtednes.show.info.instalments_details.total_amount') , $model->price , ['readonly' => 'readonly']) !!}
                            {!! field()->number('paid' ,__('indebtednes::dashboard.indebtednes.show.info.instalments_details.paid_amount') , $model->total_paid , ['readonly' => 'readonly']) !!}
                            {!! field()->number('remaining' ,__('indebtednes::dashboard.indebtednes.show.info.instalments_details.remaining_amount') , $model->total_installment_remaining , ['readonly' => 'readonly']) !!}
                            {!! field()->number('pay_now' ,__('indebtednes::dashboard.indebtednes.show.info.instalments_details.pay_amount') , $model->total_installment_remaining,['step'=> '0.001']) !!}
                            {!! field()->date('transaction_date' ,__('indebtednes::dashboard.indebtednes.show.info.instalments_details.transaction_date')) !!}
                            {!! field()->textarea('note',__('indebtednes::dashboard.indebtednes.show.info.instalments_details.note'),null,['class' => 'form-control']) !!}
                        </div>
                        <div class="modal-footer">
                            <div class="clearfix"></div>
                            <br>
                            <button type="submit" id="submit"
                                    class="btn btn-primary">
                                {{__('apps::dashboard.buttons.add')}}
                            </button>
                            <button type="button"
                                    class="btn btn-white"
                                    data-dismiss="modal">
                                {{__('indebtednes::dashboard.indebtednes.show.btn.cancel')}}
                            </button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <br>
        @endif
    @endcan
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-social-dribbble font-blue"></i>
                <span class="caption-subject font-blue bold uppercase">{{__('indebtednes::dashboard.indebtednes.show.titles.instalments')}}</span>
            </div>
        </div>
        <div class="portlet-body">
            @if($model->installments->count())
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-advance table-hover">
                        <thead>
                        <th>#</th>
                        <th class="text-center">{{__('indebtednes::dashboard.indebtednes.show.info.instalments_details.paid_amount')}}</th>
                        <th class="text-center">{{__('indebtednes::dashboard.indebtednes.show.info.instalments_details.transaction_date')}}</th>
                        <th class="text-center">{{__('indebtednes::dashboard.indebtednes.show.info.instalments_details.status')}}</th>
                        <th class="text-center">{{__('indebtednes::dashboard.indebtednes.show.info.instalments_details.details')}}</th>
                        <th class="text-center">{{__('indebtednes::dashboard.indebtednes.show.info.instalments_details.pay')}} </th>
                        </thead>
                        <tbody>
                        @php $count = 1; @endphp
                        @foreach($model->installments as $record)
                            <tr id="removable{{$record->id}}">
                                <td>
                                    {{$count}}
                                </td>
                                <td class="text-center">{{$record->paid}}</td>
                                <td class="text-center">
                                    {{optional($record)->transaction_date}}
                                </td>

                                <td class="text-center">
                                    @switch($record->status)

                                        @case('not_complete')
                                        <label class="label label-danger">
                                            {{__('indebtednes::dashboard.indebtednes.show.info.instalments_details.not_complete')}}
                                        </label>
                                        @break

                                        @case('completed')
                                        <label class="label label-success">
                                            {{__('indebtednes::dashboard.indebtednes.show.info.instalments_details.completed')}}
                                        </label>
                                        @break

                                        @case('waiting')
                                        <label class="label label-warning">
                                            {{__('indebtednes::dashboard.indebtednes.show.info.instalments_details.waiting')}}
                                        </label>
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
                                                            {{__('indebtednes::dashboard.indebtednes.show.info.instalments_details.not_complete')}}
                                                        </label>
                                                        @break

                                                        @case('completed')
                                                        <label class="label label-success">
                                                            {{__('indebtednes::dashboard.indebtednes.show.info.instalments_details.completed')}}
                                                        </label>
                                                        @break

                                                        @case('waiting')
                                                        <label class="label label-warning">
                                                            {{__('indebtednes::dashboard.indebtednes.show.info.instalments_details.waiting')}}
                                                        </label>
                                                        @break

                                                    @endswitch
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>
                                                            {{__('indebtednes::dashboard.indebtednes.show.info.instalments_details.paid_amount')}}
                                                            : </strong> {{$record->paid}}
                                                    </p>
                                                    <p><strong>
                                                            {{__('indebtednes::dashboard.indebtednes.show.info.instalments_details.transaction_date')}}
                                                            : </strong>
                                                        {{optional($record)->transaction_date}}
                                                    </p>
                                                    <p style="    background-color: #5555551f;border-radius: 3px;padding: 13px 7px;">
                                                        <strong>
                                                            {{__('indebtednes::dashboard.indebtednes.show.info.instalments_details.note')}}
                                                            : </strong>
                                                        <span>{{$record->note}}</span>
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button"
                                                            class="btn btn-default"
                                                            data-dismiss="modal"
                                                            style="background-color: #00c0ef;color: white">
                                                        {{__('indebtednes::dashboard.indebtednes.show.btn.cancel')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="text-center">

                                    @can('pay_indebtednes')

                                        <a onclick="cancelPay('{{url(route("dashboard.indebtednes.cancel",[$model->id , $record->id]))}}')"
                                           href="#"
                                           class="btn btn-info">
                                            {{__('indebtednes::dashboard.indebtednes.show.btn.cancel_pay')}}
                                        </a>
                                    @else

                                        <a disabled
                                           href="#"
                                           class="btn btn-info">
                                            {{__('indebtednes::dashboard.indebtednes.show.btn.cancel_pay')}}
                                        </a>
                                    @endcan
                                </td>

                            </tr>
                            @php $count ++; @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>


            @else
                <div class="note note-danger text-center" id="error_message">
                    <h4 class="block">{{__('indebtednes::dashboard.indebtednes.show.titles.no_indebtednes_to_show')}}</h4>
                </div>
            @endif
        </div>
    </div>
</div>