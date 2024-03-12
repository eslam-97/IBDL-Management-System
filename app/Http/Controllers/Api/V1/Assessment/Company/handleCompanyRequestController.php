<?php

namespace App\Http\Controllers\Api\V1\Assessment\Company;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\V1\Assessment\Company\CompanyController;
use Illuminate\Http\Request;

class handleCompanyRequestController extends Controller
{

    public function handleCompanyRequest($type,request $request)
    {
        return match ($type) {
          'get' => app(CompanyController::class)->index(),
          'store' => app(CompanyController::class)->store(),
          'update' => app(CompanyController::class)->update(),
          'show' => app(CompanyController::class)->show(),
          'delete' => app(CompanyController::class)->destroy(),
          default => response()->json(['error' => 'Invalid type for Company'], 400),
        };
    }
}