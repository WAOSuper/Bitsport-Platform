<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Jobs\RevokedMatches;
use File;

use DB;
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $cronLog = storage_path('logs/cron1.log');
        // if (!File::exists($cronLog)) {
        //     File::put($cronLog, '');
        // }
        $schedule->call(function () {
            // $cronLog = storage_path('logs/cron2.log');
            // if (!File::exists($cronLog)) {
            //     File::put($cronLog, '');
            // }
            // dispatch(new RevokedMatches());
        // })->cron('* * * * *');
           
        })->everyMinute();
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
