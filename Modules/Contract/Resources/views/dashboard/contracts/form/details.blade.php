<h4>{{ __('contract::dashboard.contracts.form.details') }}</h4><hr>
<div class="alert alert-info" role="alert">
    {{__('contract::dashboard.contracts.form.details_name_is_important')}}
</div>
<table class="table table-responsive" id="details_table">
    <thead class="thead-dark">
        <th class="text-center">{{__('contract::dashboard.contracts.form.contract_type')}}</th>
        <th class="text-center">{{__('contract::dashboard.contracts.form.name')}}</th>
        <th class="text-center">{{__('contract::dashboard.contracts.form.description')}}</th>
        <th class="text-center">{{__('contract::dashboard.contracts.form.notes')}}</th>
        <th class="text-center">{{__('contract::dashboard.contracts.form.price')}}</th>
        <th class="text-center"></th>
    </thead>
    <tbody>
    @isset($model)
        @forelse ($model->lines as $line)
            @include('contract::dashboard.contracts.partials.details', ['line' => $line, 'fill' => true])
        @empty

        @endforelse
    @else

    @endisset

    @include('contract::dashboard.contracts.partials.details', ['fill' => false])
    </tbody>
</table>

@section('scripts')
@parent
<script>
$("body").on("click", ".add_details", function(e)
{
    e.preventDefault();
    $('#details_table').each(function(){
        var new_data= $('tr:last', this).clone().find('input').val('').end();
        new_data.appendTo(this);

    });
})

$(document).on("click", ".remove_details", function(e) {
    if($('#details_table tbody tr').length > 1){
        $(this).closest('tr').remove()
    }
})
</script>
@endsection
