<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected $commands = [
        Commands\AuctionExpire::class,
        Commands\WinStatus::class,
        Commands\OrderDate::class,
        Commands\OrderDeclined::class,
    ];
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('auctions:auctionExp')->cron('* * * * *');
        $schedule->command('bid:winStatus')->cron('* * * * *');
        $schedule->command('order:SetOrderDate')->cron('* * * * *');
        $schedule->command('order:OrderDeclined')->cron('* * * * *');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
