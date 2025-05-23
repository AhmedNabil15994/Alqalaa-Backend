<html  lang="{{ locale() }}" dir="{{ is_rtl() }}">
@section('title',__('authentication::client.login.routes.index'))
<link rel="stylesheet" href="{{ url('admin/assets/pages/css/login.min.css') }}">
@include('apps::client.layouts._head_ltr')
<body class="login">
<div class="content">

    {!! Form::open([
                    'url'=> route('client.login'),
                    'id'=>'form',
                    'role'=>'form',
                    'method'=>'POST',
                    'class'=>'login-form',
                    ])!!}

    <h3 class="form-title font-green">{{ __('authentication::client.login.routes.index') }}</h3>

    {!! field('dashboard_login')->text('user_name',__('authentication::client.login.form.user_name'),null,
    ['class' => 'form-control form-control-solid placeholder-no-fix']) !!}
    
    {!! field('dashboard_login')->password('password',__('authentication::client.login.form.password'),
    ['class' => 'form-control form-control-solid placeholder-no-fix']) !!}

    <div class="form-actions">
        <button type="submit" class="btn green uppercase">
            {{ __('authentication::client.login.form.btn.login') }}
        </button>
    </div>
    {!! Form::close()!!}
</div>
@include('apps::client.layouts._footer')
@include('apps::client.layouts._jquery')
</body>
</html>
