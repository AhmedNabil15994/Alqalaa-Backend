@inject('month_presents','Modules\Contract\Entities\MonthPercentage')
@inject('contract_status','Modules\Contract\Entities\ContractStatus')

{!! field()->date('transaction_date', __('contract::dashboard.contracts.form.transaction_date') ,
$model->transaction_date ? \Carbon\Carbon::parse($model->transaction_date)->format('Y-m-d'): null) !!}
{!! field()->number('price', __('contract::dashboard.contracts.form.price'),null,['step'=> '0.01']) !!}
{!! field()->number('down_payment', __('contract::dashboard.contracts.form.down_payment'),null,['step'=> '0.01']) !!}
{!! field()->select('month_percentage_id', __('contract::dashboard.contracts.form.month_percentage_id'),$month_presents->active()->pluck('month_number','id')->toArray()) !!}

@can('edit_contract_percentages')
    {!! field()->number('installment_fees', __('contract::dashboard.contracts.form.installment_fees'),null,['step'=> '0.01']) !!}
    {!! field()->number('months_num', __('contract::dashboard.contracts.form.months_num')) !!}
@else
    {!! Form::hidden('installment_fees', null , ['id' => 'installment_fees']) !!}
    {!! Form::hidden('months_num', null , ['id' => 'months_num']) !!}
@endcan

@can('can_update_contract_status')
    {!! field()->select('contract_status_id', __('contract::dashboard.contracts.form.contract_status'),$contract_status->pluck('title','id')->toArray(),
        isset(optional($model)->status['id']) ? optional($model)->status['id'] : null
    ) !!}
@endcan
<br>
<div class="col-lg-6">
    {!! field('readonly')->number('remaining', __('contract::dashboard.contracts.form.remaining'),null,['readonly' => 'readonly']) !!}
</div>
<div class="col-lg-6">
    {!! field('readonly')->number('installment_with_fees', __('contract::dashboard.contracts.form.installment_with_fees')
    ,null,['readonly' => 'readonly']) !!}
</div>
<div class="col-lg-6">
    {!! field('readonly')->number('installment_value', __('contract::dashboard.contracts.form.installment_value')
    ,null,['readonly' => 'readonly']) !!}
</div>
<div class="col-lg-6">
    {!! field('readonly')->number('total_with_installment_with_fees', __('contract::dashboard.contracts.form.total_with_installment_with_fees')
    ,null,['readonly' => 'readonly']) !!}
</div>

{{-- {!! field()->textarea('note', __('Note')) !!} --}}

@if ($model->trashed())
    {!! field()->checkBox('trash_restore', __('contract::dashboard.contracts.form.restore')) !!}
@endif

@push('scripts')
    <script>
        $('#month_percentage_id').change(function () {
            var id = $('#month_percentage_id').val();
            var url = '{{ route("dashboard.month-percentages.get-by-id", ":id") }}';
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                type: 'get',
                success: function (data) {
                    $('#installment_fees').val(data.presentage);
                    $('#months_num').val(data.month_number);
                    calculateInstallment();
                },
            });
        });
    </script>
    <script>

        var down_payment_input = $("#down_payment");
        var months_num_input = $("#months_num");
        var installment_fees_input = $("#installment_fees");
        var price_input = $("#price");
        var total_input = $("#total_with_installment_with_fees");

        down_payment_input.keyup(function () {
            calculateInstallment();
        });
        months_num_input.keyup(function () {
            calculateInstallment();
        });
        installment_fees_input.keyup(function () {
            calculateInstallment();
        });
        price_input.keyup(function () {
            calculateInstallment();
        });

        function calculateInstallment() {
            var price = price_input.val();
            var percent = installment_fees_input.val();
            var down_payment = down_payment_input.val();
            var months_num = months_num_input.val();
            var remaining = 0;
            var installment_with_fees = 0;

            if (down_payment >= 0) {
                remaining = price - down_payment;
                var percentValue = remaining * percent / 100;
                installment_with_fees = remaining + percentValue;
                $("#remaining").val(remaining);
                $("#installment_with_fees").val(installment_with_fees);
                var total = parseFloat(installment_with_fees) + parseFloat(down_payment);
                total_input.val(parseFloat(total.toFixed(2)));

                if (months_num > 0) {
                    var installment_value = parseFloat(installment_with_fees / months_num).toFixed(2);
                    $("#installment_value").val(installment_value);
                }
            }

        }

        jQuery(document).ready(function () {
            calculateInstallment();
        });
    </script>
@endpush