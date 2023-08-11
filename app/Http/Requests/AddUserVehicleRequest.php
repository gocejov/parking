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
    public function rules()
    {
        $rules = [
            'vehicle_make' => ['max:30'],
            'vehicle_model' => ['max:30'],
            'license_plate' => ['max:15'],
            'default_park_time' => ['integer'],
            'phone_number' => ['regex:/^\+?[0-9\s]+$/'],
        ];

        // Apply required rule for creation
        if ($this->isMethod('post')) {
            $rules = array_merge($rules, [
                'vehicle_make' => ['required', 'max:30'],
                'vehicle_model' => ['required', 'max:30'],
                'license_plate' => ['required', 'max:15'],
                'default_park_time' => ['required', 'integer'],
                'phone_number' => ['required', 'regex:/^\+?[0-9\s]+$/'],
            ]);
        }

        return $rules;
    }


    public function messages()
    {
        return [
            'vehicle_make.required' => 'The vehicle make field is required.',
            'vehicle_model.required' => 'The vehicle model field is required.',
            'license_plate.required' => 'The license plate field is required.',
            'default_park_time.required' => 'The default park time field is required.',
            'default_park_time.integer' => 'The default park time must be a number.',
            'phone_number.required' => 'The phone number field is required.',
        ];
    }


}
