@inject('states' ,'Modules\Area\Entities\State')


<div class="tab-content">
    @foreach (config('laravellocalization.supportedLocales') as $code => $lang)
            {!! field()->text('title['.$code.']',
            __('area::dashboard.areas.form.title').'-'.$code ,
                    $model->getTranslation('title' , $code),
                  ['data-name' => 'title.'.$code]
             ) !!}
    @endforeach
</div>

{!! field()->select('state_id',__('area::dashboard.areas.form.state'),$states->pluck('title','id')->toArray()) !!}
{!! field()->checkBox('status', __('area::dashboard.areas.form.status')) !!}
@if ($model->trashed())
    {!! field()->checkBox('trash_restore', __('area::dashboard.areas.form.restore')) !!}
@endif