<?php

namespace App\Observers;

use App\Models\Activity;
use App\Models\Booking;

class BookingObserver
{
    /**
     * Handle the Booking "created" event.
     */
    public function created(Booking $booking): void
    {
        $activity = Activity::find($booking->activity_id);

        if ($activity) {
            $activity->decrement('available_slots', $booking->slots_booked);
        }
    }

}
