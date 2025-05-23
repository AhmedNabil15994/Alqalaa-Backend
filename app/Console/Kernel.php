<?php

namespace App\Console;

use App\Console\Commands\SendWhatsapp;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Modules\Apps\Console\{AppSetupCommand,ClearDownloadsCommand};
use Modules\Installment\Console\InstalmentDailyAlert;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        ClearDownloadsCommand::class,
        AppSetupCommand::class,
        InstalmentDailyAlert::class,
        SendWhatsapp::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        if (\App::environment('production')) {
            $schedule->command('backup:clean')->daily()->at('03:00');
            $schedule->command('backup:run')->daily()->at('04:00');

//            $schedule->command('instalment:daily-alert')->dailyAt('09:00');
            $schedule->command('clear:downloads')->dailyAt('04:00');
            $schedule->command('send:WAMsgs',['--count' => 0])->dailyAt('06:00');
            $schedule->command('send:WAMsgs',['--count' => 3])->dailyAt('09:00');
        }
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
