<?php

namespace App\Listeners;

use App\Events\BookingCreated;
use App\Mail\BookingConfirmationMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendBookingConfirmationEmail
{
    public function handle(BookingCreated $event)
    {
        Mail::to($event->booking->user_email)->send(new BookingConfirmationMail($event->booking));

        $event->booking->update(['status' => 'confirmed']);
    }
}
