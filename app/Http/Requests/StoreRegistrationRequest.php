<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'room_id' => 'required',
            'arrival_time' => 'required|date',
            'departure_date' => 'required|date',
            'no_of_person' => 'required|integer|min:1|max:4',
            'name' => 'required|string|max:255',
            'id_card_number' => 'required|string',
            'phone' => 'required|string',
        ];
    }
}
