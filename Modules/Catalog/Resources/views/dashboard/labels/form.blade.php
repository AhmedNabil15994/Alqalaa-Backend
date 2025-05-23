{!! field()->langNavTabs() !!}

<div class="tab-content">
    @foreach (config('laravellocalization.supportedLocales') as $code => $lang)
        <div class="tab-pane fade in {{ ($code == locale()) ? 'active' : '' }}"
             id="first_{{$code}}">
            {!! field()->text('title['.$code.']',
            __('catalog::dashboard.labels.form.title').'-'.$code ,
             $model->getTranslation('title' , $code),
                  ['data-name' => 'title.'.$code]
             ) !!}
        </div>
    @endforeach
</div>

<div class="form-group " id="color_wrap">
    <label for="color" class="col-md-2" style="">
        @lang("catalog::dashboard.labels.form.color")
    </label>

    <div class="col-md-9" style="">
        <input value="{{$model?->color}}" placeholder="@lang("catalog::dashboard.labels.form.color")" class="form-control" data-name="color" id="color" name="color" type="color">
        <span class="help-block" style=""></span>
    </div>
</div>