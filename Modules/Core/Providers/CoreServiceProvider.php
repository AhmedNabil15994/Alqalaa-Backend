<?php

namespace Modules\Core\Providers;

use Illuminate\Console\Events\CommandFinished;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Modules\Core\Console\CreateCrudes;
use Modules\Core\Listeners\ModuleMaked;
use Modules\Core\Traits\CanPublishConfiguration;

class CoreServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;

    protected $listen = [
        CommandFinished::class => [
            ModuleMaked::class,
        ]
    ];

    protected $middleware = [
        'Authorization' => [
            'check.permission'     => 'AutoCheckPermission',
        ],
    ];
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->registerMiddleware($this->app['router']);
        $this->loadMigrationsFrom(module_path('Core', 'Database/Migrations'));
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishConfig('core', 'available-locales');
        $this->publishConfig('core', 'config');
    }

    /**
     * Register the filters.
     *
     * @param  Router $router
     * @return void
     */
    public function registerMiddleware(Router $router)
    {
        foreach ($this->middleware as $module => $middlewares) {
            foreach ($middlewares as $name => $middleware) {
                $class = "Modules\\{$module}\\Http\\Middleware\\{$middleware}";

                $router->aliasMiddleware($name, $class);
            }
        }
    }
    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/core');

        $sourcePath = module_path('Core', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/core';
        }, \Config::get('view.paths')), [$sourcePath]), 'core');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/core');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'core');
        } else {
            $this->loadTranslationsFrom(module_path('Core', 'Resources/lang'), 'core');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(module_path('Core', 'Database/factories'));
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
