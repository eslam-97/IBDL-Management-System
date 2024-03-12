<?php

namespace App\Http\Controllers\Api\V1\Exam\UserExam;

use App\Http\Controllers\Api\V1\Exam\UserExam\UserExamController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HandleUserExamRequestController extends Controller
{
    public function handleUserExamRequest($type, Request $request)
    {
        return match ($type) {
          'get' => app(UserExamController::class)->index(),
          'store' => app(UserExamController::class)->store(),
          'show' => app(UserExamController::class)->show(),
          'edit' => app(UserExamController::class)->edit(),
          'delete' => app(UserExamController::class)->destroy(),
          default => response()->json(['error' => 'Invalid type for User Exam'], 400),
        };
    }
}
