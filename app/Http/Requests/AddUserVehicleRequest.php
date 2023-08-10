<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddUserVehicleRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'phone_number' => ['regex:/^\+?[0-9\s]+$/'],
            'license_plate' => ['max:15'],
            'default_park_time' => ['integer'],
            'vehicle_make' => ['max:15'],
            'vehicle_model' => ['max:15'],
        ];
    }
}
