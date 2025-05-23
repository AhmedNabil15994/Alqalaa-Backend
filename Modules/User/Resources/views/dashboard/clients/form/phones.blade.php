<div class="phones-form">
    @if($model->phones && $model->phones()->count())
        @foreach($model->phones as $phone)
            @php $rand = rand(1,999999999); @endphp
            @if($loop->index == 0)

                {!! field()->number('phones['.$rand.']' , __('user::dashboard.clients.form.phone'),$phone->phone,['data-name' => 'phones.'.$rand]) !!}
            @else
                <div class="row delete-content" style="margin: 0px;">
                    <div class="col-xs-10">
                        {!! field()->number('phones['.$rand.']' , __('user::dashboard.clients.form.phone'),$phone->phone,['data-name' => 'phones.'.$rand]) !!}
                    </div>
                    <div class="col-xs-2">
                    <span class="input-group-btn">
                        <a data-input="images" data-preview="holder" class="btn btn-danger delete-phone">
                            <i class="fa fa-trash"></i>
                        </a>
                    </span>
                    </div>
                </div>
            @endif
        @endforeach
    @else
        {!! field()->number('phones[0]' , __('user::dashboard.clients.form.phone'),null,['data-name' => 'phones.0']) !!}
    @endif
</div>
<div class="form-group">
    <button
            type="button"
            class="btn btn-sm green add-phone"
            data-style="slide-down"
            data-spinner-color="#333">
        <i class="fa fa-plus-circle"></i>
        {{ __('user::dashboard.clients.form.add_other_phone')}}
    </button>
</div>

@push('styles')
    <style>
        .get-phones-form a {
            display: none;
        }
    </style>
@endpush
@push('scripts')
    <script>
        // member FORM / ADD NEW member
        $(document).ready(function () {
            var html =
                '        <div class="row delete-content" style="    margin: 0px;">' +
                '            <div class="col-xs-10">' +
                '                <div class="form-group  " id="phones[::index]_wrap">' +
                '                    <label  for="phones[::index]" class="col-md-2">{{__('user::dashboard.clients.form.phone')}}</label>' +
                '                    <div class="col-md-9" style="">' +
                '                       <input placeholder="{{__('user::dashboard.clients.form.phone')}}" class="form-control" data-name="phones.::index" id="phones[::index]" name="phones[::index]" type="number" value="">' +
                '                       <span class="help-block" style=""></span>' +
                '                     </div>' +
                '                </div>' +
                '            </div>' +
                '            <div class="col-xs-2">' +
                '                <span class="input-group-btn">' +
                '                    <a data-input="images" data-preview="holder" class="btn btn-danger delete-phone">' +
                '                        <i class="fa fa-trash"></i>' +
                '                    </a>' +
                '                </span>' +
                '            </div>' +
                '        </div>';

            $(".add-phone").click(function (e) {
                var content = html;

                var rand = Math.floor(Math.random() * 9000000000) + 1000000000;
                content = replaceAll(content, '::index', rand);
                e.preventDefault();
                $(".phones-form").append(content);
            });
        });

        // DELETE member BUTTON
        $(".phones-form").on("click", ".delete-phone", function (e) {
            e.preventDefault();
            $(this).closest('.delete-content').remove();
        });

        function escapeRegExp(string) {
            return string.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");
        }

        /* Define functin to find and replace specified term with replacement string */
        function replaceAll(str, term, replacement) {
            return str.replace(new RegExp(escapeRegExp(term), 'g'), replacement);
        }
    </script>
@endpush