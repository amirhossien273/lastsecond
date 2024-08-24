<?php

namespace App\Console\Commands;

use App\Mail\ActivityReminderMail;
use App\Models\Booking;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendActivityReminderEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-activity-reminder-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $bookings = Booking::with('activity')
        ->where('status', 'confirmed')
        ->whereHas('activity', function ($query) {
            $query->where('start_date', '=', now()->addDay());
        })
        ->get();

    foreach ($bookings as $booking) {
        Mail::to($booking->user_email)->send(new ActivityReminderMail($booking));
    }
    }
}
