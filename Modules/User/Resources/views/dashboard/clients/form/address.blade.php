@inject('states','Modules\Area\Entities\State')

{!! field()->select('state_id', __('user::dashboard.clients.form.states'), $states->pluck('title','id')->toArray(),optional($model->address)->state_id) !!}
{!! field()->text('street', __('user::dashboard.clients.form.street'),optional($model->address)->street) !!}