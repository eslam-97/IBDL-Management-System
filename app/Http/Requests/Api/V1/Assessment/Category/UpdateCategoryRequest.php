<?php

namespace App\Http\Requests\Api\V1\Assessment\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'language_id' => ['required', 'exists:languages,id'],
            'name' => ['required', 'string'],
            'category_code' => ['required', 'string'],
            'detail' => ['required', 'string'],
            'score' => ['required', 'string']
        ];
    }
}