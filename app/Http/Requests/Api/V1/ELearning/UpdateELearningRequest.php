<?php

namespace App\Http\Requests\Api\V1\ELearning;

use Illuminate\Foundation\Http\FormRequest;

class UpdateELearningRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule','array','string>
     */
    public static function rules(): array
    {
        return [
            'name' => ['nullable','string'],
            'instruction' => ['nullable','string'],
            'logo' => ['nullable','string'],
            'language_id' => ['nullable'],
            'start_time' => ['nullable'],
            'end_time' => ['nullable'],
            'finished' => ['nullable','boolean'],
            'user_id' => ['nullable','exists:users,id'],
        ];
    }
}
