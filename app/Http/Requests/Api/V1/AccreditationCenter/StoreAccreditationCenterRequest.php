<?php

namespace App\Http\Requests\Api\V1\AccreditationCenter;

use Illuminate\Foundation\Http\FormRequest;

class StoreAccreditationCenterRequest extends FormRequest
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
            'field' => ['required', 'string'],
            'type_accreditation_center' => ['required', 'string'],
            'website' => ['nullable'],
            'tex_trg' => ['nullable'],
            'license' => ['nullable'],
            'accreditation' => ['nullable'],
            'approve' => ['nullable'],
            'quality_manual' => ['nullable'],
            'comm_req' => ['nullable'],
            'contact_person' => ['required', 'string'],
            'contact_email' => ['required','email'],
            'contact_phone' => ['required', 'string'],
            'contact_title' => ['required', 'string'],
        ];
    }
}