<?php

namespace App\Http\Requests\Api\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public static function rules(): array
    {
        return [
            'name' => ['required','string'],
            'email' => ['required','email','unique:users','max:255'],
            'password' => ['required','string','min:8','confirmed']
        ];
    }
}
