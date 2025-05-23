@extends('apps::frontend.layouts.main')


@section('style')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;500&display=swap" rel="stylesheet">

    <style>

        body {
            font-family: 'Cairo', sans-serif;
            background: linear-gradient(87deg, #172b4d 0, #1a174d 100%) !important;
        }

        .section-lg {

            padding-bottom: 7rem;
        }

        #form {
            padding-left: 0px;
            margin-top: 7rem;
            background-color: #ffffff00;
            box-shadow: 12px 8px 40px -16px #003977;
            text-align: left;
        }

        #form input {
            background-color: #faf6fb;
        }

        .la {
            color: #f8f9fa;
            font-size: 1.1rem;
            font-weight: 600;
        }

        #form strong {
            padding-left: 5px;
            color: #8b000080;
        }


        .error_sms {
            color: #ffffff;
            background-color: #ee5e2dad;
            font-size: .9rem;
            padding: 0px 9px;
            border-radius: 5px;
            width: 100%;
            display: none;
            font-weight: 700;
        }

    </style>



@endsection
@section('content')


    <main>
        <section class="section section-shaped section-lg">
            <div class="shape shape-style-1 bg-gradient-default">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="card bg-secondary shadow border-0">
                        <div class="container-form" id="container">
                            <div class="form-container sign-up-container">
                                <div class="card bg-secondary shadow border-0">
                                    <div class="card-header bg-white pb-5">
                                        <div class="text-muted text-center mb-3">
                                            <h3>{{__('apps::frontend.admin')}}</h3>
                                        </div>
                                        <div class="text-center">
                                            <i class="fas fa-cash-register fa-3x"></i>
                                        </div>
                                    </div>
                                    <div class="card-body px-lg-5 py-lg-5">

                                        @if(!auth()->check())
                                            {!! Form::open(['url' => route('dashboard.login') , 'method' => 'post' ,'id'=> 'addCashier' ,'class'=>'mt-5' ]) !!}

                                            <div class="form-group">
                                                <div class="input-group input-group-alternative mb-3"
                                                     id="input_cashier_email">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                    class="ni ni-email-83"></i></span>
                                                    </div>
                                                    {!! Form::email('email',null,[
                                                        'class' => 'form-control',
                                                        'placeholder' => 'Email',

                                                    ]) !!}

                                                </div>
                                                <label id="contact_cashier_email" class="error_sms"></label>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group input-group-alternative"
                                                     id="input_cashier_password">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                                class="ni ni-lock-circle-open"></i></span>
                                                    </div>

                                                    {!! Form::password('password',[
                                                        'class' => 'form-control',
                                                        'placeholder' => 'Password'
                                                    ]) !!}

                                                </div>
                                                <label id="contact_cashier_password" class="error_sms"></label>
                                            </div>
                                            <div class="text-center">
                                                <button type="button" class="btn btn-primary mt-4"
                                                        id="cashier_btn">{{__('apps::frontend.login')}}</button>
                                            </div>

                                            {!! Form::close() !!}
                                        @else
                                            <div class="text-center" style="margin-bottom: 6rem;
    margin-top: 3rem;">
                                                <a href="{{route('dashboard.home')}}" class="btn btn-primary mt-4"
                                                   style="color: white">{{__('apps::frontend.home_page')}}</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-container sign-in-container">
                                <div class="card bg-secondary shadow border-0">
                                    <div class="card-header bg-white pb-5">
                                        <div class="text-muted text-center mb-3">
                                            <h3>{{__('apps::frontend.client')}}</h3>
                                        </div>
                                        <div class="text-center">
                                            <i class="fas fa-user-tie fa-3x"></i>
                                        </div>
                                    </div>
                                    <div class="card-body px-lg-5 py-lg-5">

                                        @if(!auth('client')->check())
                                            {!! Form::open(['url' => route('client.login') , 'method' => 'post' ,'id'=> 'addPartner' ,'class'=>'mt-5' ]) !!}
                                            <div class="form-group">
                                                <div class="input-group input-group-alternative mb-3"
                                                     id="input_partner_email">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                    class="ni ni-email-83"></i></span>
                                                    </div>
                                                    {!! Form::email('user_name',null,[
                                                        'class' => 'form-control',
                                                        'placeholder' => 'Civil ID'
                                                    ]) !!}

                                                </div>
                                                <label id="contact_partner_user_name" class="error_sms"></label>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group input-group-alternative"
                                                     id="input_partner_password">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                                class="ni ni-lock-circle-open"></i></span>
                                                    </div>

                                                    {!! Form::password('password',[
                                                        'class' => 'form-control',
                                                        'placeholder' => 'Password'
                                                    ]) !!}

                                                </div>
                                                <label id="contact_partner_password" class="error_sms"></label>
                                            </div>
                                            <div class="text-center" style="    margin-top: -29px;">
                                                <button type="button" class="btn btn-primary mt-4"
                                                        id="partner_btn">{{__('apps::frontend.login')}}</button>
                                            </div>
                                            {!! Form::close() !!}
                                        @else
                                            <div class="text-center" style="margin-bottom: 6rem;
    margin-top: 3rem;">
                                                <a href="{{route('client.home')}}" class="btn btn-primary mt-4"
                                                   style="color: white">{{__('apps::frontend.home_page')}}</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="overlay-container">
                                <div class="overlay">
                                    <div class="overlay-panel overlay-left">
                                        <h1><i class="fas fa-user-tie fa-2x"></i></h1>
                                        <h3>{{__('apps::frontend.client')}}</h3>

                                        <button class="ghost btn btn-warning"
                                                id="signIn">{{__('apps::frontend.login')}}</button>
                                    </div>
                                    <div class="overlay-panel overlay-right">
                                        <h1><i class="fas fa-cash-register fa-2x"></i></h1>
                                        <h3>{{__('apps::frontend.admin')}}</h3>
                                        <button class="ghost btn btn-success"
                                                id="signUp">{{__('apps::frontend.login')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </main>


@endsection


{{--            UPLOAD--}}

@section('script')
    <script>
        $(document).ready(function () {

            $('#navbar-main').css('background-color', '#16254d');
            var inputs =
                [
                    'cashier_email',
                    'cashier_password',
                    'partner_user_name',
                    'partner_password',
                ];


            $('#cashier_btn').on('click', function (e) {
                e.preventDefault();
                var url = $('#addCashier').attr('action');
                var form_data = $('#addCashier').serialize();

                $('.error_sms').hide();

                $('#cashier_btn').attr('disabled', 'disabled');

                for (var i = 0; i < inputs.length; i++) {
                    $('#input_' + inputs[i] + '').css('border', '');
                }

                $.ajax({
                    url: url,
                    type: 'post',
                    data: form_data,
                    success: function (data) {

                        var url = data.url;

                        if (url) {

                            window.location = url;
                        }


                    },
                    error: function (data) {
                        var error = data.responseJSON.errors;

                        $('#cashier_btn').removeAttr('disabled');


                        if (error.hasOwnProperty('email')) {
                            $('#contact_cashier_email').text('').append('<i class="error_fontawai fas fa-exclamation-circle" style="padding-left: 4px"></i>' + error['email'] + '');
                            $('#contact_cashier_email').show();
                            $('#input_cashier_email').css('border', '1px solid red');

                        }
                        if (error.hasOwnProperty('password')) {
                            $('#contact_cashier_password').text('').append('<i class="error_fontawai fas fa-exclamation-circle" style="padding-left: 4px"></i>' + error['password'] + '');
                            $('#contact_cashier_password').show();
                            $('#input_cashier_password').css('border', '1px solid red');

                        }

                    }
                });
            });


            $('#partner_btn').on('click', function (e) {
                e.preventDefault();
                var url = $('#addPartner').attr('action');
                var form_data = $('#addPartner').serialize();

                $('.error_sms').hide();

                $('#partner_btn').attr('disabled', 'disabled');

                for (var i = 0; i < inputs.length; i++) {
                    $('#input_' + inputs[i] + '').css('border', '');
                }

                $.ajax({
                    url: url,
                    type: 'post',
                    data: form_data,
                    success: function (data) {

                        var url = data.url;

                        if (url) {

                            window.location = url;
                        }


                    },
                    error: function (data) {
                        var error = data.responseJSON.errors;

                        $('#partner_btn').removeAttr('disabled');


                        if (error.hasOwnProperty('user_name')) {
                            console.log(error);
                            $('#contact_partner_user_name').text('').append('<i class="error_fontawai fas fa-exclamation-circle" style="padding-left: 4px"></i>' + error['user_name'] + '');
                            $('#contact_partner_user_name').show();
                            $('#input_partner_user_name').css('border', '1px solid red');

                        }
                        if (error.hasOwnProperty('password')) {
                            $('#contact_partner_password').text('').append('<i class="error_fontawai fas fa-exclamation-circle" style="padding-left: 4px"></i>' + error['password'] + '');
                            $('#contact_partner_password').show();
                            $('#input_partner_password').css('border', '1px solid red');

                        }

                    }
                });
            });
        });
    </script>
@stop

