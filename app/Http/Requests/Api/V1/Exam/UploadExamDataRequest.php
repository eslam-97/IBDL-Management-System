<?php

namespace App\Http\Requests\Api\V1\Exam;

use Illuminate\Foundation\Http\FormRequest;

class UploadExamDataRequest extends FormRequest
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
            'file' => ['required', 'file', 'mimes:xlsx'],
            'exam_id' => ['required','exists:exams,id']
        ];
    }
}