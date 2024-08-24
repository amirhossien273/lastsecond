<?php

namespace App\Listeners;

use App\Events\BookingCreated;
use App\Mail\AdminBookingNotificationMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class NotifyAdminOfBooking
{
    public function handle(BookingCreated $event)
    {
        Mail::to('admin@example.com')->send(new AdminBookingNotificationMail($event->booking));
    }
}
