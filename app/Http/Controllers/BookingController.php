<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BookingController extends Controller
{   
   /**
    *
    * @return AnonymousResourceCollection
    *
    */
   public function index(): AnonymousResourceCollection
   {
       return BookingResource::collection(Booking::all());
   }

   /**
    *
    * @param  BookingRequest  $request
    * @return BookingResource
    *
    */
   public function store(BookingRequest $request): BookingResource
   {
        $booking = Booking::create($request->validated());

        return new BookingResource($booking);
    }

    /**
     *
     * @param  Booking  $booking
     * @return BookingResource
     *
     */
    public function show(Booking $booking): BookingResource
    {
        return new BookingResource($booking);
    }

    /**
     *
     * @param  BookingRequest  $request
     * @param  Booking  $booking
     * @return BookingResource
     *
     */
    public function update(BookingRequest $request, Booking $booking): BookingResource
    {
        $booking->update($request->validated());
        return new BookingResource($booking);
    }

    /**
     *
     * @param  Booking  $booking
     * @return Response
     *
     */
    public function destroy(Booking $booking): Response
    {
        $booking->delete();
        return response()->noContent();
    }
}
