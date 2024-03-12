<?php

namespace App\Http\Requests\Api\V1\ELearning\Chapter;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChapterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public static function rules(): array
    {
        return [
            'name' =>[ 'required','string'],
            'content' =>[ 'required','string'],
            'e_learning_id' => ['required'],
            'start_time' => ['required'],
            'end_time' => ['required'],
            'user_id' => ['required','exists:users,id'],
        ];
    }
}
