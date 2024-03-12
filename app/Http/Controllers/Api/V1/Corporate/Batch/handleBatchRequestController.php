<?php

namespace App\Http\Controllers\Api\V1\Corporate\Batch;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\V1\Corporate\Batch\BatchController;
use App\Http\Requests\Api\V1\Batch\StoreBatchRequest;
use Illuminate\Http\Request;

class handleBatchRequestController extends Controller
{

    public function handleBatchRequest($type,request $request)
    {
        return match ($type) {
          'get' => app(BatchController::class)->index(),
          'store' => app(BatchController::class)->store(),
          'update' => app(BatchController::class)->update(),
          'show' => app(BatchController::class)->show(),
          'delete' => app(BatchController::class)->destroy(),
          default => response()->json(['error' => 'Invalid type for Batch'], 400),
        };
    }






}