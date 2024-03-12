<?php

namespace App\Http\Controllers\Api\V1\Assessment\Category;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\V1\Assessment\Category\CategoryController;
use Illuminate\Http\Request;

class handleCategoryRequestController extends Controller
{

    public function handleCategoryRequest($type,request $request)
    {
        return match ($type) {
          'get' => app(CategoryController::class)->index(),
          'store' => app(CategoryController::class)->store(),
          'update' => app(CategoryController::class)->update(),
          'show' => app(CategoryController::class)->show(),
          'upload' => app(CategoryController::class)->uploadAssessmentCategory(),
          'delete' => app(CategoryController::class)->destroy(),
          default => response()->json(['error' => 'Invalid type for Category'], 400),
        };
    }
}