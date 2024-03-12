<?php

namespace App\Http\Requests\Api\V1\AccreditationCenter;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAccreditationCenterRequest extends FormRequest
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
            'country' => ['nullable', 'string'],
            'city' => ['nullable', 'string'],
            'phone' => ['nullable', 'string'],
            'field' => ['nullable', 'string'],
            'type_accreditation_center' => ['nullable', 'string'],
            'website' => ['nullable'],
            'tex_trg' => ['nullable'],
            'license' => ['nullable'],
            'accreditation' => ['nullable'],
            'approve' => ['nullable'],
            'quality_manual' => ['nullable'],
            'comm_req' => ['nullable'],
            'contact_person' => ['nullable', 'string'],
            'contact_email' => ['nullable','email'],
            'contact_phone' => ['nullable', 'string'],
            'contact_title' => ['nullable', 'string'],
        ];
    }
}