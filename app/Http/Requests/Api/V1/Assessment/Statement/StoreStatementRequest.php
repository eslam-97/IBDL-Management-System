<?php

namespace App\Http\Requests\Api\V1\Assessment\Statement;

use Illuminate\Foundation\Http\FormRequest;

class StoreStatementRequest extends FormRequest
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
            'code' => ['required', 'string','unique:assessment_statements,code'],
            'statement' => ['required', 'string'],
            'assessment_category_id' => ['required', 'exists:assessment_categories,id'],
            'value' => ['required', 'string']
        ];
    }
}