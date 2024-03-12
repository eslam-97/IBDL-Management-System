<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Api\V1\Auth\GetAuthUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Controller;


class handleAuthRequestController extends Controller
{

    public function handleAuthRequest($type, Request $request)
    {
        switch ($type) {
            case 'user':
                return app(GetAuthUser::class)->__invoke();
            case 'login':
                return app(LoginController::class)->__invoke($request);
            default:
                return response()->json(['error' => 'Invalid type for auth'], 400);
        }
    }



}