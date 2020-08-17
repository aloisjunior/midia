<?php

namespace ARsig\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \ARsig\Console\Commands\ExecutarUrl::class,
        \ARsig\Console\Commands\SendFCMMessage::class,
        \ARsig\Console\Commands\ConsultaCNPJReceitaWs::class,
        \ARsig\Console\Commands\ConsultaCEP::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

//        $schedule->exec('c:\php\php.exe D:\_Trabalho\desenvolvimento\php-laravel\atonsig\artisan queue:work  --stop-when-empty --queue=cloudconvert')
//            ->everyMinute();

//        $schedule->command('queue:work --stop-when-empty --queue=cloudconvert')
//            ->everyMinute();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
