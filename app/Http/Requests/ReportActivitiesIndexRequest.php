<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportActivitiesIndexRequest extends FormRequest
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
            'name'            => 'nullable|string|max:255',
            'location'        => 'nullable|string|max:255',
            'price_min'       => 'nullable|numeric|min:0',
            'price_max'       => 'nullable|numeric|gte:price_min',
            'available_slots' => 'nullable|integer|min:0',
            'per_page'        => 'nullable|integer|min:1|max:100',
        ];
    }
}
