<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ReportActivityCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'name'            => $this->name,
            'description'     => $this->description,
            'location'        => $this->location,
            'price'           => $this->price,
            'available_slots' => $this->available_slots,
            'start_date'      => $this->start_date->toDateTimeString(),
        ];
    }
}
