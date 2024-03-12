<?php

namespace App\Http\Controllers\Api\V1\Assessment\Advice;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\V1\Assessment\Advice\AdviceController;
use Illuminate\Http\Request;

class handleAdviceRequestController extends Controller
{

    public function handleAdviceRequest($type,request $request)
    {
        return match ($type) {
          'get' => app(AdviceController::class)->index(),
          'store' => app(AdviceController::class)->store(),
          'update' => app(AdviceController::class)->update(),
          'show' => app(AdviceController::class)->show(),
          'upload' => app(AdviceController::class)->uploadAssessmentAdvice(),
          'delete' => app(AdviceController::class)->destroy(),
          default => response()->json(['error' => 'Invalid type for Advice'], 400),
        };
    }
}