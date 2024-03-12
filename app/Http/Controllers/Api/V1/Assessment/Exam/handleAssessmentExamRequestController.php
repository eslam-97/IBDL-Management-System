<?php

namespace App\Http\Controllers\Api\V1\Assessment\Exam;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\V1\Assessment\Exam\AssessmentExamController;
use Illuminate\Http\Request;

class handleAssessmentExamRequestController extends Controller
{
    public function handleExamRequest($type,request $request)
    {
        return match ($type) {
          'get' => app(AssessmentExamController::class)->index(),
          'store' => app(AssessmentExamController::class)->store(),
          'update' => app(AssessmentExamController::class)->update(),
          'show' => app(AssessmentExamController::class)->show(),
          'upload' => app(AssessmentExamController::class)->uploadAssessmentExam(),
          'delete' => app(AssessmentExamController::class)->destroy(),
          default => response()->json(['error' => 'Invalid type for Exam'], 400),
        };
    }
}