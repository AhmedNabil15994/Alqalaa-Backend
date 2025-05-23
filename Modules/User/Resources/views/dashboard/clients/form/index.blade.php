<div class="tab-pane active fade in" id="global_setting">
    <div class="col-md-10">
        @include('user::dashboard.clients.form.general')
        @include('user::dashboard.clients.form.phones')
        @include('user::dashboard.clients.form.address')
    </div>
</div>
<div class="tab-pane fade" id="attachment">
    <div class="col-md-10">
        @include('user::dashboard.clients.form.attachments')
    </div>
</div>