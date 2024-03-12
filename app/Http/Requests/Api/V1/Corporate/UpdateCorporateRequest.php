<?php

namespace App\Http\Requests\Api\V1\Corporate;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCorporateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public static function rules(): array
    {
        return [
            'name' => ['nullable','string'],
            'email' => ['nullable','email'],
            'country' => ['nullable','string'],
            'city' => ['nullable','string'],
            'phone' => ['nullable','string'],
            'filed' => ['nullable','string'],
            'corporate_type' => ['nullable','string'],
            'website' => ['nullable','string'],
            'contact_person' => ['nullable','string'],
            'contact_email' => ['nullable','email'],
            'contact_phone' => ['nullable','string'],
            'contact_title' => ['nullable','string'],
        ];
    }
}
