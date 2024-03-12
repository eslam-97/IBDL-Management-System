<?php

namespace App\Http\Requests\Api\V1\ELearning;

use Illuminate\Foundation\Http\FormRequest;

class StoreELearningRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public static function rules(): array
    {
        return [
            'name' => ['required','string'],
            'instruction' => ['required','string'],
            'logo' => ['required','string'],
            'language_id' => ['required'],
            'start_time' => ['required'],
            'end_time' => ['required'],
            'finished' => ['required','boolean'],
            'user_id' => ['required','exists:users,id'],
        ];
    }
}
