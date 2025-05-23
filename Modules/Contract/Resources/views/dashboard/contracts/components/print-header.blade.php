<div class="clearfix" style="width: 100%"></div>
    <center>
        <h2 class="caption-subject font-orange bold uppercase" style="color: #f5ae1a">
            @if($type=="contract") {{__('contract::dashboard.contracts.show.info.contract.contract_a_deal')}}
            @elseif($type=="invoice") {{__('contract::dashboard.contracts.show.info.contract.invoice')}}
            @elseif($type=="insurance") {{__('contract::dashboard.contracts.show.info.contract.insurance')}}
            @endif
        </h2>
    </center>