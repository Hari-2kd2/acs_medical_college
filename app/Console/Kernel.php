<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        Commands\Payslip::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('employee:payslip')->everyMinute();
        $schedule->call(function(){
            info('schedule-running');
        } )->everyMinute();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
