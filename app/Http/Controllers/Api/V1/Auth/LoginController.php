<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Helpers\XorHelper;
use App\Http\Controllers\Controller;
use App\Repository\Auth\AuthRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct(protected AuthRepositoryInterface $auth)
    {
    }


    public function __invoke(Request $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');    
        $token = $this->auth->login($credentials);
    
        return $this->successResponse(['token' => $token], 200);
    }
}