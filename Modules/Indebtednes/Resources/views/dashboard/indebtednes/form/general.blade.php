{!! field()->number('price', __('indebtednes::dashboard.indebtednes.form.price')) !!}
{!! field()->text('note', __('indebtednes::dashboard.indebtednes.form.note')) !!}
<br>

@if ($model->trashed())
    {!! field()->checkBox('trash_restore', __('indebtednes::dashboard.indebtednes.form.restore')) !!}
@endif