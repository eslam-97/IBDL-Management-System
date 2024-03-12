<?php

namespace App\Http\Controllers\Api\V1\AccreditationCenter;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\V1\AccreditationCenter\AccreditationCenterController;
use Illuminate\Http\Request;


class handleAccreditationCenterRequestController extends Controller
{

    public function handleAccreditationCenterRequest($type, Request $request)
    {
        switch ($type) {
            case 'get':
                return app(AccreditationCenterController::class)->index();
            case 'store':
                return app(AccreditationCenterController::class)->store();
            case 'update':
                return app(AccreditationCenterController::class)->update();
            case 'show':
                return app(AccreditationCenterController::class)->show();
            case 'delete':
                return app(AccreditationCenterController::class)->destroy();
            default:
                return response()->json(['error' => 'Invalid type for AccreditationCenter'], 400);
        }
    }



}
