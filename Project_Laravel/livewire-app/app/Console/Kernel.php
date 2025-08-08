<?php

namespace App\Console;

use app\Console\Commands\DeleteExpiredImages;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected $commands = [
        DeleteExpiredImages::class, // Add your command here
    ];

    


    protected function schedule(Schedule $schedule): void
    {
        // Add your scheduled commands here.
        // For example, your delete command:
        // $schedule->command('images:delete-expired')->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}