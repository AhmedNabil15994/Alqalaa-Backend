<?php

namespace Modules\Apps\Providers;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\Core\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected $module_name = 'Apps';

    protected $frontend_routes = [
        'routes.php',
    ];

    protected $dashboard_routes = [
        'routes.php',
    ];

    protected $client = [
        'routes.php',
    ];

    protected $api_routes = [

        'routes.php',
    ];


    protected function frontendGroups(){

        return [
            'middleware' => config('core.route-middleware.frontend.guest'),
            'prefix' => LaravelLocalization::setLocale() . config('core.route-prefix.frontend')
        ];
    }

    protected function dashboardGroups(){

        return [
            'middleware' => config('core.route-middleware.dashboard.auth'),
            'prefix' => LaravelLocalization::setLocale() . config('core.route-prefix.dashboard')
        ];
    }

    protected function clientGroups(){

        return [
            'middleware' => config('core.route-middleware.client.auth'),
            'prefix' => LaravelLocalization::setLocale() . config('core.route-prefix.client')
        ];
    }

    protected function apiGroups(){

        return [
            'middleware' => config('core.route-middleware.api.guest'),
            'prefix' => config('core.route-prefix.api')
        ];
    }
}
