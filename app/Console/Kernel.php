<?php

namespace App\Console;

use App\Jobs\CheckDomainAvailability;
use App\Jobs\ProcessGenerateWord;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected function schedule(Schedule $schedule): void
    {
        $schedule->job(new ProcessGenerateWord())
            ->everySecond();

//        $schedule->job(new CheckDomainAvailability())
//            ->everySecond();

    }


    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
