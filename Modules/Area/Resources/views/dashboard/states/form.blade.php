@inject('cities' ,'Modules\Area\Entities\City')

<div class="tab-content">
    @foreach (config('laravellocalization.supportedLocales') as $code => $lang)

            {!! field()->text('title['.$code.']',
            __('area::dashboard.cities.form.title').'-'.$code ,
                    $model->getTranslation('title' , $code),
                  ['data-name' => 'title.'.$code]
             ) !!}
    @endforeach
</div>

{!! field()->select('city_id',__('area::dashboard.states.form.cities'),$cities->pluck('title','id')->toArray()) !!}
{!! field()->checkBox('status', __('area::dashboard.cities.form.status')) !!}
@if ($model->trashed())
    {!! field()->checkBox('trash_restore', __('area::dashboard.cities.form.restore')) !!}
@endif