<?php

namespace App\Http\Requests\Api\V1\Corporate;

use Illuminate\Foundation\Http\FormRequest;

class StoreCorporateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public static function rules(): array
    {
        return [
            'name' => ['required','string'],
            'email' => ['required','email'],
            'country' => ['required','string'],
            'city' => ['required','string'],
            'phone' => ['required','string'],
            'filed' => ['required','string'],
            'corporate_type' => ['required','string'],
            'website' => ['nullable','string'],
            'contact_person' => ['required','string'],
            'contact_email' => ['required','email'],
            'contact_phone' => ['required','string'],
            'contact_title' => ['required','string'],
        ];
    }
}
