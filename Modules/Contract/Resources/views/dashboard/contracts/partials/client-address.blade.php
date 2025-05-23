<address class="m-t-5 m-b-5">
    <strong class="text-inverse">
        {{__('contract::dashboard.contracts.show.titles.client')}}
    </strong><br><br>
    <div class="invoice-detail">
        <div class="row static-info">
                    <span class="name"> {{__('contract::dashboard.contracts.show.info.client.name')}}
                        :
                    </span>
            <span class="value"> {{optional($model->client)->getTranslation('name','ar')}}</span>
        </div>
        <div class="row static-info">
                    <span class="name"> {{__('contract::dashboard.contracts.show.info.client.name-en')}}
                        :
                    </span>
            <span class="value"> {{optional($model->client)->getTranslation('name','en')}}</span>
        </div>
        <div class="row static-info">
                    <span class="name"> {{__('contract::dashboard.contracts.show.info.client.national_ID')}}
                        :
                    </span>
            <span class="value"> {{optional($model->client)->national_ID}}</span>
        </div>

        <div class="row static-info">
                    <span class="name"> {{__('contract::dashboard.contracts.show.info.client.phones')}}
                        :
                    </span>
            <span class="value">
                        <div class="well">
                            @if(optional($model->client->phones())->count())
                                @foreach($model->client->phones as $phone)
                                    {{$phone->code.$phone->phone}}<br>
                                @endforeach
                            @endif
                        </div>
                    </span>
        </div>
        <div class="row static-info">
            <span class="name"> {{__('contract::dashboard.contracts.show.info.client.address')}}
                :
            </span>
            <span class="value">
                <span class="label label-primary label-md">
                    {{optional(optional(optional($model->client)->address)->state)->title}}-
                    {{optional(optional($model->client)->address)->street}}
                </span>
            </span>
        </div>
        <div class="row static-info">
            <span class="name"> {{__('contract::dashboard.contracts.show.info.client.work_info')}}
                :
            </span>
            <span class="value">
                <span class="label label-primary label-md">
                    {{$model->client->work_info ?? '--'}}
                </span>
            </span>
        </div>
    </div>
</address>