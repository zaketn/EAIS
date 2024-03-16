<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('download:excel-files')->monthlyOn(16, '00:00');
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        $this->load(__DIR__.'/../routes/console.php');
    }
}
