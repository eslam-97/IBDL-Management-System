<?php

namespace App\Http\Controllers\Api\V1\Exam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HandleExamRequestController extends Controller
{
  public function handleExamRequest($type, Request $request)
  {
    return match ($type) {
      'get' => app(ExamController::class)->index(),
      'store' => app(ExamController::class)->store(),
      'show' => app(ExamController::class)->show(),
      'update' => app(ExamController::class)->update(),
      'delete' => app(ExamController::class)->destroy(),
      'upload' => app(ExamController::class)->uploadExamData(),
      default => response()->json(['error' => 'Invalid type for Exam'], 400),
    };
  }
}