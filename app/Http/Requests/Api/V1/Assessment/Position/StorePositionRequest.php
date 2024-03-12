<?php

namespace App\Http\Requests\Api\V1\Assessment\Position;

use Illuminate\Foundation\Http\FormRequest;

class StorePositionRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public static function rules(): array
    {
        return [
            'language_id' => ['required', 'exists:languages,id'],
            'assessment_company_id' => ['required', 'exists:assessment_companies,id'],
            'name' => ['required', 'string'],
        ];
    }
}
