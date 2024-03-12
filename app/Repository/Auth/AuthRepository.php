<?php

namespace App\Repository\Auth;

use App\Helpers\XorHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthRepository implements AuthRepositoryInterface
{


    public function login($credentials)
    {
        $credentials = $this->applyXorDecryption($credentials);

        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'error' => ['Invalid credentials'],
            ]);
        }

        return Auth::user()->createToken('MyApp')->accessToken;
    }

    private function applyXorDecryption(array $data)
    {
        $fieldsToDecrypt = ['email', 'password'];

        foreach ($fieldsToDecrypt as $field) {
            if (isset($data[$field])) {
                $data[$field] = XorHelper::xor($data[$field]);
            }
        }

        return $data;
    }
}