

{!! field()->langNavTabs() !!}

<div class="tab-content">
    @foreach (config('laravellocalization.supportedLocales') as $code => $lang)
        <div class="tab-pane fade in {{ ($code == locale()) ? 'active' : '' }}"
             id="first_{{$code}}">
            {!! field()->text('title['.$code.']',
            __('contract::dashboard.contract-status.form.title').'-'.$code ,
             $model->getTranslation('title' , $code),
                  ['data-name' => 'title.'.$code]
             ) !!}
        </div>
    @endforeach
</div>

{!! field()->checkBox('is_pending', __('contract::dashboard.contract-status.form.is_pending')) !!}
{!! field()->checkBox('is_active', __('contract::dashboard.contract-status.form.accept_status')) !!}
