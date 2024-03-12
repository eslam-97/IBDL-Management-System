<?php

namespace App\Http\Requests\Api\V1\AccreditationCenter\AccreditationTrainer;


use Illuminate\Foundation\Http\FormRequest;

class StoreAccreditationTrainerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public static function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'country' => ['required', 'string'],
            'city' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'birth_date' => ['required', 'string'],
            'type_accreditation_trainer' => ['required', 'string'],
            'website' => ['nullable'],
            'gender' => ['nullable'],
            'company' => ['nullable'],
            'title' => ['nullable'],
            'brief' => ['nullable'],
            'training_field' => ['nullable'],
            'training_hours' => ['nullable'],
            'accreditation_center_id' => ['required'],
        ];
    }
}