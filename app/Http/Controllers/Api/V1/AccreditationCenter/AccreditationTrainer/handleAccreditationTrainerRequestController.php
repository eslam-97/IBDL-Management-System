<?php

namespace App\Http\Controllers\Api\V1\AccreditationCenter\AccreditationTrainer;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\V1\AccreditationCenter\AccreditationTrainer\AccreditationTrainerController;
use Illuminate\Http\Request;


class handleAccreditationTrainerRequestController extends Controller
{

    public function handleAccreditationTrainerRequest($type, Request $request)
    {
        switch ($type) {
            case 'get':
                return app(AccreditationTrainerController::class)->index();
            case 'store':
                return app(AccreditationTrainerController::class)->store();
            case 'update':
                return app(AccreditationTrainerController::class)->update();
            case 'show':
                return app(AccreditationTrainerController::class)->show();
            case 'delete':
                return app(AccreditationTrainerController::class)->destroy();
            default:
                return response()->json(['error' => 'Invalid type for AccreditationTrainer'], 400);
        }
    }



}
