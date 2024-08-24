<?php

namespace App\Jobs;

use App\Mail\ActivityReminderMail;
use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendReminderEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function handle()
    {
        $activity = $this->booking->activity;
        if ($activity->start_date->subDay()->isToday()) {
            Mail::to($this->booking->user_email)->send(new ActivityReminderMail($this->booking));
        }
    }
}
