<?php

namespace Modules\Core\Providers;

use Illuminate\Console\Events\CommandFinished;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Core\Listeners\ModuleMaked;

class EventServiceProvider extends ServiceProvider
{

    protected $listen = [
        CommandFinished::class => [
            ModuleMaked::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
