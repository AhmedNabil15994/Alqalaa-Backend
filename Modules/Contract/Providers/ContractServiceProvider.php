<?php

namespace Modules\Contract\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class ContractServiceProvider extends ServiceProvider
{
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
        $this->loadMigrationsFrom(module_path('Contract', 'Database/Migrations'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path('Contract', 'Config/config.php') => config_path('contract.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('Contract', 'Config/config.php'), 'contract'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/contract');

        $sourcePath = module_path('Contract', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/contract';
        }, \Config::get('view.paths')), [$sourcePath]), 'contract');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/contract');

        $attributesPath = module_path('Contract','Resources/lang/'.app()->getLocale().'/attributes.php');
        if(file_exists($attributesPath))
            setValidationAttributes(include $attributesPath);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'contract');
        } else {
            $this->loadTranslationsFrom(module_path('Contract', 'Resources/lang'), 'contract');
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
            app(Factory::class)->load(module_path('Contract', 'Database/factories'));
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
