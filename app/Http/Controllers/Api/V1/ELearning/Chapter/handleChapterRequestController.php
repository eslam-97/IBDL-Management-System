<?php

namespace App\Http\Controllers\Api\V1\ELearning\Chapter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\ELearning\Chapter\ChapterController;

class handleChapterRequestController extends Controller
{

    public function handleChapterRequest($type, Request $request)
    {
        switch ($type) {
            case 'get':
                return app(ChapterController::class)->index();
            case 'store':
                return app(ChapterController::class)->store();
            case 'show':
                return app(ChapterController::class)->show();
            case 'edit':
                return app(ChapterController::class)->edit();
            case 'update':
                return app(ChapterController::class)->update();
            case 'delete':
                return app(ChapterController::class)->destroy();
            default:
                return response()->json(['error' => 'Invalid type for Chapter'], 400);
        }
    }
}
