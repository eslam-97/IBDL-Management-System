<?php

namespace App\Http\Controllers\Api\V1\Assessment\Statement;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\V1\Assessment\Statement\StatementController;
use Illuminate\Http\Request;

class handleStatementRequestController extends Controller
{
    public function handleStatementRequest($type,request $request)
    {
        return match ($type) {
          'get' => app(StatementController::class)->index(),
          'store' => app(StatementController::class)->store(),
          'update' => app(StatementController::class)->update(),
          'show' => app(StatementController::class)->show(),
          'upload' => app(StatementController::class)->uploadAssessmentStatement(),
          'delete' => app(StatementController::class)->destroy(),
          default => response()->json(['error' => 'Invalid type for Statement'], 400),
        };
    }
}