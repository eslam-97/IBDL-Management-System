<?php

namespace App\Http\Requests\Api\V1\Assessment\Exam;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public static function rules(): array
    {
        return [
            'statement_one_id' => ['required','exists:assessment_statements,id'],
            'statement_two_id' => ['required','exists:assessment_statements,id'],
        ];
    }
}
