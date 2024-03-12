<?php

namespace App\Http\Controllers\Api\V1\Exam\LiveTracking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HandleLiveTrackingRequestController extends Controller
{
    public function handleLiveTrackingRequest($type, Request $request)
    {
        return match ($type) {
          'get' => app(LiveTrackingController::class)->index(),
          'store' => app(LiveTrackingController::class)->store(),
          'show' => app(LiveTrackingController::class)->show(),
          'delete' => app(LiveTrackingController::class)->destroy(),
          default => response()->json(['error' => 'Invalid type for Live Tracking'], 400),
        };
    }
}
