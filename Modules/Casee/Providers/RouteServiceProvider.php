<?php

namespace Modules\Casee\Providers;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\Core\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{

    protected $module_name = 'Casee';

    protected $frontend_routes = [
        'routes.php',
    ];
    protected $dashboard_routes = [
        'routes.php',
        'case-actions.php',
    ];
    protected $api_routes = [

        'routes.php',
    ];

    protected function frontendGroups(){

        return [
            'middleware' => config('core.route-middleware.frontend.auth'),
            'prefix' => LaravelLocalization::setLocale() . config('core.route-prefix.frontend')
        ];
    }

    protected function dashboardGroups(){

        return [
            'middleware' => config('core.route-middleware.dashboard.auth'),
            'prefix' => LaravelLocalization::setLocale() . config('core.route-prefix.dashboard')
        ];
    }

    protected function apiGroups(){

        return [
            'middleware' => config('core.route-middleware.api.auth'),
            'prefix' => config('core.route-prefix.api')
        ];
    }
}
