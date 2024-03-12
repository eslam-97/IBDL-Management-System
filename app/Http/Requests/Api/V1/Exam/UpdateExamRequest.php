<?php

namespace App\Http\Requests\Api\V1\Exam;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExamRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public static function rules(): array
    {
        return [
            'name' => ['required','string'],
            'exam_duration' => ['required','integer'],
            'instructions' => ['required','string'],
            'e_learning_id' => ['required','integer'],
            'language_id' => ['required','integer'],
            'data' => ['nullable', 'array'],
            'data.*.id' => ['nullable', 'integer'],
            'data.*.question' => ['nullable', 'string'],
            'data.*.ans1' => ['nullable', 'string'],
            'data.*.ans2' => ['nullable', 'string'],
            'data.*.ans3' => ['nullable', 'string'],
            'data.*.ans4' => ['nullable', 'string'],
            'data.*.ans5' => ['nullable', 'string'],
            'data.*.right_ans' => ['nullable', 'string'],
            'data.*.lan' => ['nullable', 'integer'],
            'data.*.difficulty' => ['nullable', 'integer'],
            'data.*.level' => ['nullable', 'integer'],
            'data.*.chapter' => ['nullable', 'integer']
        ];
    }
}
