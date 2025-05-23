 <!-- begin invoice-price -->
 <div class="invoice-header" style="padding: 14px 48px 68px;padding-bottom: 104px;">
    <div>
        <div>

            <div style="text-align: {{locale() == 'en' ? 'left' : 'right'}};margin-bottom: 16px;">
                <h5 class="caption-subject font-orange bold uppercase" style="color: #f5ae1a">
                    {{__('contract::dashboard.contracts.show.titles.second_party')}}
                </h5>
            </div>

            <div class="sub-price" style="    float: {{locale() == 'en' ? 'left' : 'right'}};">
                <span class="text-inverse">{{__('contract::dashboard.contracts.show.titles.client_name')}}</span>
            </div>
            <div class="sub-price" style="    float: {{locale() == 'en' ? 'right' : 'left'}};">
                <small>  </small>
                <span class="text-inverse">{{__('contract::dashboard.contracts.show.titles.client_signature')}}</span>
            </div>
        </div>
    </div>
</div>
<!-- end invoice-price -->