<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Reserve;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $today = new Carbon();
        // $today = Carbon::today();
        // $dates = Reserve::whereDate('start', $today)->get();

        // foreach ($dates as $date) {
            $schedule->call(function () {
            $today = Carbon::today();
            Reserve::whereDate('start', $today)->get();
            })->dailyAt('09:00');
        // }
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
