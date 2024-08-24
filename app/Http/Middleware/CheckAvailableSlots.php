<?php

namespace App\Http\Middleware;

use App\Models\Activity;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAvailableSlots
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $activity = Activity::find($request->activity_id);

        if (!$activity) {
            return $next($request);
        }

        if ($activity->available_slots < $request->slots_booked) {
            return $this->insufficientSlotsResponse();
        }

        return $next($request);
    }

    /**
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function insufficientSlotsResponse(): \Illuminate\Http\JsonResponse
    {
        return response()->json(['error' => 'Not enough available slots'], 400);
    }
}
