<?php

namespace App\Http\Requests;

class ReservationRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:50',
            'mobile' => 'required|string|max:10',
            'type_id' => 'required|integer',
            'location_type' => 'required|in:indoor,outdoor',
            'price' => 'required|numeric',
            'price_remaining' => 'required|numeric',
            'photographer' => 'required|integer',
            'status_id' => 'required|integer',
            'has_video' => 'required|boolean',
            'date' => 'required|date',
            'start' => 'required|date_format:H:i',
            'end' => 'required|date_format:H:i|after:time_start',
            'note' => 'nullable|string',

        ];
    }
}
