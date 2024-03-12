<?php

namespace App\Http\Requests\Api\V1\Corporate\Batch;

use Illuminate\Foundation\Http\FormRequest;

class StoreBatchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public static function rules(): array
    {
        return [
            'name' =>[ 'required','string'],
            'email' => ['required','email'],
            'start_date' =>[ 'required','string'],
            'end_date' =>[ 'required','string'],
            'success_rate' =>[ 'required','string'],
            'progress' =>[ 'required','string'],
            'corporate_id' => ['required'],
        ];
    }
}
