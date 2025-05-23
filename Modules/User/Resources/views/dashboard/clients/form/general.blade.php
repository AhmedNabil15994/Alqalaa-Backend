@inject('nationalities','Modules\Catalog\Entities\Nationality')
@inject('labels','Modules\Catalog\Entities\Label')

<div class="tab-content">
    @foreach (config('laravellocalization.supportedLocales') as $code => $lang)

        {!! field()->text('name['.$code.']',
            __('user::dashboard.clients.form.name').'-'.$code ,
                $model->getTranslation('name' , $code),
              ['data-name' => 'name.'.$code]
         ) !!}
    @endforeach
</div>

{!! field()->email('email', __('user::dashboard.clients.form.email')) !!}
{!! field()->number('national_ID', __('user::dashboard.clients.form.national_ID')) !!}
{!! field()->select('nationality_id', __('user::dashboard.clients.form.nationality_id'),$nationalities->pluck('title','id')->toArray()) !!}
{!! field()->multiSelect('labels', __('Labels'),$labels->pluck('title','id')->toArray(),$model?->labels?->pluck('id')->toArray()) !!}
{!! field()->text('work_info', __('Work information')) !!}

@can('active_unactive_clients')
{!! field()->checkBox('status', __('user::dashboard.clients.form.status')) !!}
@endcan
@can('is_judging_clients')
{!! field()->checkBox('is_judging', __('user::dashboard.clients.form.is_judging')) !!}
@endcan

@if ($model->trashed())
    {!! field()->checkBox('trash_restore', __('user::dashboard.clients.form.restore')) !!}
@endif