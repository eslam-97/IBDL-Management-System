<?php

namespace App\Http\Controllers\Api\V1\Assessment\Position;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\V1\Assessment\Position\PositionController;
use Illuminate\Http\Request;

class handlePositionRequestController extends Controller
{
    public function handlePositionRequest($type,request $request)
    {
        return match ($type) {
          'get' => app(PositionController::class)->index(),
          'store' => app(PositionController::class)->store(),
          'update' => app(PositionController::class)->update(),
          'show' => app(PositionController::class)->show(),
          'delete' => app(PositionController::class)->destroy(),
          default => response()->json(['error' => 'Invalid type for Position'], 400),
        };
    }
}