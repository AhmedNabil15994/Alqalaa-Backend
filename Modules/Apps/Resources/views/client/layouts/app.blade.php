<!DOCTYPE html>
<html lang="{{ locale() }}" dir="{{ is_rtl() }}">

@if (is_rtl() == 'rtl')
    @include('apps::client.layouts._head_rtl')
@else
    @include('apps::client.layouts._head_ltr')
@endif

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md page-sidebar-closed">

<div class="page-wrapper">

    @include('apps::client.layouts._header')

    <div class="clearfix"></div>

    <div class="page-container" style="    background-color: #fff;">
        @if(auth('client')->user()->is_judging == 1)

            <div class="alert alert-danger" >
                <strong>{{__('apps::client.messages.you_are_in_judging')}}</strong>
            </div>
        @endif
        @yield('content')
    </div>

    @include('apps::client.layouts._footer')
</div>

@include('apps::client.layouts._jquery')
@include('apps::client.layouts._js')
</body>
</html>
