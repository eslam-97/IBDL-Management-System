<?php

namespace App\Http\Requests\Api\V1\AccreditationCenter\AccreditationTrainer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAccreditationTrainerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public static function rules(): array
    {
        return [
            'name' => ['nullable', 'string'],
            'email' => ['nullable', 'email'],
            'country' => ['required', 'string'],
            'city' => ['nullable', 'string'],
            'phone' => ['nullable', 'string'],
            'birth_date' => ['nullable', 'string'],
            'type_accreditation_trainer' => ['nullable', 'string'],
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