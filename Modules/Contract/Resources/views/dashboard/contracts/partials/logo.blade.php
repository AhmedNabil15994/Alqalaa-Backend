<div class="invoice-company text-inverse f-w-600">

    <div style="text-align: center;">
        <span class="pull-right hidden-print" style="    margin-top: 49px;">
            <h5 class="caption-subject font-orange bold uppercase" style="color: #f5ae1a">
                {{ setting('app_name','ar') }}
            </h5>
        </span>
        <img src="{{ setting('favicon') ? url(setting('favicon')) : '' }}" style="height: 115px;">

        <span class="pull-left hidden-print" style="    margin-top: 49px;">
            <h6 class="caption-subject font-orange bold uppercase" style="color: #f5ae1a">
            {{ setting('app_name','en') }}
            </h6>
        </span>
    </div>
</div>