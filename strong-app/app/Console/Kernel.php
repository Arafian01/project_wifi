<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        // Menjalankan command tagihan:generate setiap akhir bulan pukul 00:00
        $schedule->command('tagihan:generate')->lastOfMonth('00:00');
    }
}
