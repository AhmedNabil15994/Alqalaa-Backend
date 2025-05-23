{!! field(!empty($field_type) ? $field_type : 'dashboard_login')->select('client_id', __('installment::dashboard.installments.filters.clients'), [], null)!!}
@push('scripts')
    <script>
        $(document).ready(function () {
            $('#client_id').select2({
                width: "off",
                ajax: {
                    url: "{{url(route('dashboard.clients.select.search'))}}",
                    data: function (params) {
                        var query = {
                            search: {'value': params.term},
                        };

                        // Query parameters will be ?search=[term]&type=public
                        return query;
                    },
                    processResults: function (data, page) {
                        return {
                            results: data.items
                        };
                    },
                    cache: true
                },
                escapeMarkup: function (markup) {
                    return markup;
                }, // let our custom formatter work
                minimumInputLength: 1,
                templateResult: formatRepo,
                templateSelection: formatRepoSelection
            });

        });
    </script>
@endpush


