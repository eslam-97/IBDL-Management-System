<?php

namespace App\Http\Controllers\Api\V1\Exam\Chapter;

use App\Http\Controllers\Api\V1\Exam\Chapter\ExamChapterController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HandleExamChapterRequestController extends Controller
{
    public function handleChapterRequest($type, Request $request)
    {
        switch ($type) {
            case 'get':
                return app(ExamChapterController::class)->index();
            case 'store':
                return app(ExamChapterController::class)->store();
            case 'show':
                return app(ExamChapterController::class)->show();
            case 'update':
                return app(ExamChapterController::class)->update();
            case 'delete':
                return app(ExamChapterController::class)->destroy();
            default:
                return response()->json(['error' => 'Invalid type for Chapter'], 400);
        }
    }
}