@inject('clients','Modules\User\Entities\Client')


<div class="hide-inputs" id="chose-input">
    {!! field()->select('client_id', __('contract::dashboard.contracts.form.client_id'),$clients->all()->pluck('selector_name','id')->toArray()) !!}
</div>

<div class="hide-inputs" id="create-input" style="display: none">
    @inject('nationalities','Modules\Catalog\Entities\Nationality')

    <div class="tab-content">
        @foreach (config('laravellocalization.supportedLocales') as $code => $lang)

            {!! field()->text('name['.$code.']',
                __('user::dashboard.clients.form.name').'-'.$code ,
                    null,
                  ['data-name' => 'name.'.$code]
             ) !!}
        @endforeach
    </div>

    {!! field()->email('email', __('user::dashboard.clients.form.email')) !!}
    {!! field()->number('national_ID', __('user::dashboard.clients.form.national_ID')) !!}
    {!! field()->select('nationality_id', __('user::dashboard.clients.form.nationality_id'),$nationalities->pluck('title','id')->toArray()) !!}
    {!! field()->text('work_info', __('Work information')) !!}
    
    @include('user::dashboard.clients.form.address')
    @include('user::dashboard.clients.form.phones')
    <div class="clearfix"></div>
    <br>

    @can('active_unactive_clients')
        {!! field()->checkBox('status', __('user::dashboard.clients.form.status')) !!}
    @endcan
    <br>
    <div class="row">
        <div class="col-lg-6">
            {!! field('readonly')->multiFileUpload('national_id_photo',__('user::dashboard.clients.form.national_id_photo')) !!}
        </div>
        <div class="col-lg-6">
            {!! field('readonly')->multiFileUpload('contract_photo',__('user::dashboard.clients.form.contract_photo')) !!}
        </div>
    </div>

</div>

@push('scripts')
    <script>
        $('input[name=client_type]').change(function () {
            $('.hide-inputs').hide();
            $('#' + this.value + '-input').show();
        })
    </script>
@endpush