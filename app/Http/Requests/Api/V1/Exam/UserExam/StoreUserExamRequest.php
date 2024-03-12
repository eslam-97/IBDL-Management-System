<?php

namespace App\Http\Requests\Api\V1\Exam\UserExam;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserExamRequest extends FormRequest
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
            'result' => ['required'],
            'exam_id' => ['required','integer'],
            'user_id' => ['required','integer'],
        ];
    }
}
