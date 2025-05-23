<div class="tab-pane " id="contract_terms">

    {!! field()->number('contract[max_price]',  __('Max contract price'),setting('contract','max_price')) !!}
    {!! field()->number('contract[min_price]',  __('Min contract price'),setting('contract','min_price')) !!}
    {!! field()->number('contract[lawyer_cost]',  __('Lawyer Cost'),setting('contract','lawyer_cost') ?? 500) !!}

    <div class="col-md-10">
       {!! field()->textarea('contract[terms]',  __('setting::dashboard.settings.form.tabs.contract_terms'),setting('contract','terms')) !!}
    </div>
</div>
