<?php

namespace App\Http\Controllers\Api\V1\ELearning;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\ELearning\ELearningController;
use App\Http\Controllers\Controller;
class handleELearningRequestController extends Controller
{
    public function handleELearningRequest($type, Request $request)
    {
        switch ($type) {
            case 'get':
                return app(ELearningController::class)->index();
            case 'store':
                return app(ELearningController::class)->store();
            case 'show':
                return app(ELearningController::class)->show();
            case 'edit':
                return app(ELearningController::class)->edit();
            case 'update':
                return app(ELearningController::class)->update();
            case 'delete':
                return app(ELearningController::class)->destroy();

            default:
                return response()->json(['error' => 'Invalid type for e-learning'], 400);
        }
    }
}
