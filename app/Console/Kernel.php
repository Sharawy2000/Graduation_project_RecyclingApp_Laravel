<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
    }
    // protected function schedule(Schedule $schedule)
    // {
    //     // Define the task to run daily
    //     $schedule->call(function () {
    //         // Logic to delete old confirm notifications
    //         DB::table('confirm_notifications')
    //             ->where('created_at', '<', Carbon::now()->subDays(1))
    //             ->delete();
    //     })->daily();
    // }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
    
}
