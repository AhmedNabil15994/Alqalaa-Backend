@inject('clients' ,'Modules\User\Entities\Client')

{!! field()->select('client_id',__('casee::dashboard.case-actions.form.client_id'),$clients->get()->pluck('selector_name','id')->toArray(),request('client_id') ?? null) !!}
{!! field()->textarea('description' , __('casee::dashboard.case-actions.form.description')) !!}
{!! field()->number('price' , __('casee::dashboard.case-actions.form.indebtedness')) !!}

{!! field()->checkBox('paid', __('casee::dashboard.case-actions.form.paid')) !!}
@if ($model->trashed())
    {!! field()->checkBox('trash_restore', __('casee::dashboard.case-actions.form.restore')) !!}
@endif