{!! field()->multiFileUpload('national_id_photo',__('user::dashboard.clients.form.national_id_photo')) !!}

@if($model->getMedia('national_ids'))
    @foreach($model->getMedia('national_ids') as $media)

        <div class="cbp-item web-design graphic" id="attach-{{$media->id}}">
            <div class="cbp-caption">
                <div class="cbp-caption-defaultWrap">
                    <img src="{{str_contains($media->mime_type,'image')? $media->getUrl() : asset('uploads/file.png')}}"
                         alt="" style="max-width: 300px">
                </div>
                <div class="cbp-caption-activeWrap">
                    <div class="cbp-l-caption-alignCenter">
                        <div class="cbp-l-caption-body">
                            <a
                                    target="_blank"
                                    href="{{$media->getUrl()}}"
                                    class="cbp-singlePage cbp-l-caption-buttonLeft btn green uppercase btn green uppercase"
                                    rel="nofollow">
                                <i class="fa fa-eye"></i>
                                {{__('apps::dashboard.buttons.show')}}
                            </a>
                            @can('delete_attachment_clients')
                                <a
                                        href="javascript:;"
                                        onclick="deleteRow('{{url(route('dashboard.clients.attachment.delete',[$model->id,'national_ids',$media->id]))}}',{{$media->id}})"
                                        class="cbp-singlePage cbp-l-caption-buttonLeft btn red uppercase btn red uppercase"
                                        rel="nofollow">
                                    <i class="fa fa-trash"></i>
                                    {{__('apps::dashboard.buttons.delete')}}
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
            <div class="cbp-l-grid-projects-desc uppercase text-center">{{$media->name}}</div>
        </div>
    @endforeach
@endif
<hr>


{!! field()->multiFileUpload('contract_photo',__('user::dashboard.clients.form.contract_photo')) !!}

@if($model->getMedia('contract'))
    @foreach($model->getMedia('contract') as $media)

        <div class="cbp-item web-design graphic" id="attach-{{$media->id}}">
            <div class="cbp-caption">
                <div class="cbp-caption-defaultWrap">
                    <img src="{{str_contains($media->mime_type,'image')? $media->getUrl() : asset('uploads/file.png')}}"
                         alt="" style="max-width: 300px">
                </div>
                <div class="cbp-caption-activeWrap">
                    <div class="cbp-l-caption-alignCenter">
                        <div class="cbp-l-caption-body">
                            <a
                                    target="_blank"
                                    href="{{$media->getUrl()}}"
                                    class="cbp-singlePage cbp-l-caption-buttonLeft btn green uppercase btn green uppercase"
                                    rel="nofollow">
                                <i class="fa fa-eye"></i>
                                {{__('apps::dashboard.buttons.show')}}
                            </a>
                            <a
                                    href="javascript:;"
                                    onclick="deleteRow('{{url(route('dashboard.clients.attachment.delete',[$model->id,'contract',$media->id]))}}',{{$media->id}})"
                                    class="cbp-singlePage cbp-l-caption-buttonLeft btn red uppercase btn red uppercase"
                                    rel="nofollow">
                                <i class="fa fa-trash"></i>
                                {{__('apps::dashboard.buttons.delete')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cbp-l-grid-projects-desc uppercase text-center">{{$media->name}}</div>
        </div>
    @endforeach
@endif
<hr>


{!! field()->multiFileUpload('other_attachments',__('user::dashboard.clients.form.other_attachments')) !!}

@if($model->getMedia('other'))
    @foreach($model->getMedia('other') as $media)

        <div class="cbp-item web-design graphic" id="attach-{{$media->id}}">
            <div class="cbp-caption">
                <div class="cbp-caption-defaultWrap">
                    <img src="{{str_contains($media->mime_type,'image')? $media->getUrl() : asset('uploads/file.png')}}"
                         alt="" style="max-width: 300px">
                </div>
                <div class="cbp-caption-activeWrap">
                    <div class="cbp-l-caption-alignCenter">
                        <div class="cbp-l-caption-body">
                            <a
                                    target="_blank"
                                    href="{{$media->getUrl()}}"
                                    class="cbp-singlePage cbp-l-caption-buttonLeft btn green uppercase btn green uppercase"
                                    rel="nofollow">
                                <i class="fa fa-eye"></i>
                                {{__('apps::dashboard.buttons.show')}}
                            </a>
                            <a
                                    href="javascript:;"
                                    onclick="deleteRow('{{url(route('dashboard.clients.attachment.delete',[$model->id,'other',$media->id]))}}',{{$media->id}})"
                                    class="cbp-singlePage cbp-l-caption-buttonLeft btn red uppercase btn red uppercase"
                                    rel="nofollow">
                                <i class="fa fa-trash"></i>
                                {{__('apps::dashboard.buttons.delete')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cbp-l-grid-projects-desc uppercase text-center">{{$media->name}}</div>
        </div>
    @endforeach
@endif


@push('scripts')
    <script>
        function deleteRow(url, id) {
            var _token = $('input[name=_token]').val();

            bootbox.confirm({
                message: '{{__('apps::dashboard.messages.delete')}}',
                buttons: {
                    confirm: {
                        label: '{{__('apps::dashboard.buttons.yes')}}',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: '{{__('apps::dashboard.buttons.no')}}',
                        className: 'btn-danger'
                    }
                },

                callback: function (result) {
                    if (result) {

                        $.ajax({
                            method: 'DELETE',
                            url: url,
                            data: {
                                _token: _token
                            },
                            success: function (msg) {
                                toastr["success"](msg[1]);
                                $('#attach-' + id).remove();
                            },
                            error: function (msg) {
                                toastr["error"](msg[1]);
                            }
                        });

                    }
                }
            });
        }
    </script>
@endpush