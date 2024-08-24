<?php

namespace App\Console;

use App\Jobs\SendReminderEmail;
use App\Models\Booking;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('app:send-activity-reminder-emails')->daily();

        $schedule->call(function () {
            $bookings = Booking::where('status', 'confirmed')
                               ->whereHas('activity', function($query) {
                                   $query->where('start_date', '<=', now()->addDay());
                               })->get();
    
            foreach ($bookings as $booking) {
                SendReminderEmail::dispatch($booking);
            }
        })->daily();

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
