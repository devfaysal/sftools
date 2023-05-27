<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        //* * * * * cd /var/www/html/tools.sf-solutions.net/repository && php artisan schedule:run >> /dev/null 2>&1
        // $schedule->command('inspire')->hourly();
        $schedule->command('PlentyMarketSyncStock')->everyTenMinutes();
        $schedule->command('ValidateImportedPlentyMarketProducts')->withoutOverlapping();
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
