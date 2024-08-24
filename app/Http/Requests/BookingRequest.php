<?php

namespace App\Http\Requests;

use App\Enums\BookingStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class BookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'activity_id'  => 'required|exists:activities,id',
            'user_name'    => 'required|string|max:255',
            'user_email'   => 'required|email|max:255',
            'slots_booked' => 'required|integer|min:1',
            'status'       => ['required', new Enum(BookingStatus::class)], // Enum validation
        ];
    }
}
