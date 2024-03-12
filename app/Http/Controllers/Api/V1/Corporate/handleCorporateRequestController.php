<?php

namespace App\Http\Controllers\Api\V1\Corporate;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\V1\Corporate\CorporateController;
use App\Http\Requests\Api\V1\Batch\StoreBatchRequest;
use App\Models\Corporate;
use Illuminate\Http\Request;


class handleCorporateRequestController extends Controller
{

    public function handleCorporateRequest($type, Request $request)
    {
        switch ($type) {
            case 'get':
                return app(CorporateController::class)->index();
            case 'store':
                return app(CorporateController::class)->store();
            case 'update':
                return app(CorporateController::class)->update();
            case 'show':
                return app(CorporateController::class)->show();
            case 'delete':
                return app(CorporateController::class)->destroy();
            default:
                return response()->json(['error' => 'Invalid type for corporate'], 400);
        }
    }



}
