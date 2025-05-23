<div class="page-header navbar navbar-fixed-top">
    <div class="page-header-inner ">

        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
           data-target=".navbar-collapse">
            <span></span>
        </a>
        <div class="top-menu">

            <ul class="nav navbar-nav pull-right">

                <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar"></li>

                <li class="dropdown dropdown-user">

                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                       data-close-others="true">

                        <span class="username username-hide-on-mobile">
                             @if(auth('client')->user()->is_credentials_changed)
                                <span class="badge badge-danger"> <i class="fa fa-exclamation" style="width: 7px;"></i> </span>
                            @endif
                            {{ auth('client')->user()->name }}
                        </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="{{url(route('client.profile'))}}">
                                <i class="icon-user"></i>
                                {{ __('apps::client._layout.navbar.profile') }}
                                @if(auth('client')->user()->is_credentials_changed)
                                    <span class="badge badge-danger"> ! </span>
                                @endif
                            </a>
                        </li>
                        <li>
                            <a href="#"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="icon-key"></i> {{ __('apps::client._layout.navbar.logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('client.logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                       data-close-others="true">
                        <span class="username username-hide-on-mobile">
                            {{ LaravelLocalization::getCurrentLocaleNative() }}
                        </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        @foreach (config('laravellocalization.supportedLocales') as $localeCode => $properties)
                            @if ($localeCode != locale())
                                <li>
                                    <a hreflang="{{ $localeCode }}"
                                       href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                        {{ $properties['native'] }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>

            </ul>

        </div>
    </div>
</div>
