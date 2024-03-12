<?php

namespace App\Http\Requests\Api\V1\Assessment\Advice;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdviceRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule','array<mixed>','string>
     */
    public static function rules(): array
    {
        return [
            'assessment_category_id' => ['required', 'exists:assessment_categories,id'],
            'language_id' => ['required', 'exists:languages,id'],
            'range_value' => ['nullable', 'string'],
            'advice' => ['nullable', 'string'],
            'advice_if_high_candidate' => ['nullable', 'string'],
            'advice_if_low_candidate' => ['nullable', 'string'],
            'advice_if_high_boss' => ['nullable', 'string'],
            'advice_if_low_boss' => ['nullable', 'string']
        ];
    }
}