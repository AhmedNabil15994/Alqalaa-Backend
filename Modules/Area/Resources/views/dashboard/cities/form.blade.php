@inject('countries' ,'Modules\Area\Entities\Country')

<div class="tab-content">
    @foreach (config('laravellocalization.supportedLocales') as $code => $lang)

            {!! field()->text('title['.$code.']',
            __('area::dashboard.cities.form.title').'-'.$code ,
                    $model->getTranslation('title' , $code),
                  ['data-name' => 'title.'.$code]
             ) !!}

    @endforeach
</div>
{!! field()->select('country_id',__('area::dashboard.cities.form.countries'),$countries->pluck('title','id')->toArray()) !!}
{!! field()->checkBox('status', __('area::dashboard.cities.form.status')) !!}
@if ($model->trashed())
    {!! field()->checkBox('trash_restore', __('area::dashboard.cities.form.restore')) !!}
@endif