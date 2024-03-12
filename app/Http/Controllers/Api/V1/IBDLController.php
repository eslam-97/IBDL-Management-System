<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\Auth\handleAuthRequestController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\V1\Exam\Chapter\HandleExamChapterRequestController;
use App\Http\Controllers\Api\V1\Exam\Chapter\HandleChapterRequestController;
use App\Http\Controllers\Api\V1\Exam\HandleExamRequestController;
use App\Http\Controllers\Api\V1\Exam\LiveTracking\HandleLiveTrackingRequestController;
use App\Http\Controllers\Api\V1\Exam\userExam\HandleUserExamRequestController;
use App\Http\Controllers\Api\V1\AccreditationCenter\AccreditationTrainer\handleAccreditationTrainerRequestController;
use App\Http\Controllers\Api\V1\AccreditationCenter\handleAccreditationCenterRequestController;
use App\Http\Controllers\Api\V1\Assessment\Exam\handleAssessmentExamRequestController;
use App\Http\Controllers\Api\V1\Assessment\Statement\handleStatementRequestController;
use App\Http\Controllers\Api\V1\ELearning\handleELearningRequestController;
use App\Http\Controllers\Api\V1\Corporate\Batch\handleBatchRequestController;
use App\Http\Controllers\Api\V1\Corporate\handleCorporateRequestController;
use App\Http\Controllers\Api\V1\Assessment\Advice\handleAdviceRequestController;
use App\Http\Controllers\Api\V1\Assessment\Category\handleCategoryRequestController;
use App\Http\Controllers\Api\V1\Assessment\Company\handleCompanyRequestController;
use App\Http\Controllers\Api\V1\Assessment\Position\handlePositionRequestController;
use Illuminate\Http\Request;


class IBDLController extends Controller
{

    /**
     * Summary of handleIBDLRequest
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function handleIBDLRequest(Request $request)
    {

        $mode = $request['mode'] ?? null;
        $type = $request['type'] ?? null;

        switch ($mode) {
            case 'e-learning':
                return app(handleELearningRequestController::class)->handleELearningRequest($type, $request);
            case 'chapter':
                return app(handleChapterRequestController::class)->handleChapterRequest($type, $request);
            case 'corporate':
                return app(handleCorporateRequestController::class)->handleCorporateRequest($type, $request);
            case 'batch':
                return app(handleBatchRequestController::class)->handleBatchRequest($type, $request);
            case 'accreditation_center':
                return app(handleAccreditationCenterRequestController::class)->handleAccreditationCenterRequest($type, $request);
            case 'accreditation_trainer':
                return app(handleAccreditationTrainerRequestController::class)->handleAccreditationTrainerRequest($type, $request);
            case 'assessment_advice':
                return app(handleAdviceRequestController::class)->handleAdviceRequest($type, $request);
            case 'assessment_company':
                return app(handleCompanyRequestController::class)->handleCompanyRequest($type, $request);
            case 'assessment_position':
                return app(handlePositionRequestController::class)->handlePositionRequest($type, $request);
            case 'assessment_category':
                return app(handleCategoryRequestController::class)->handleCategoryRequest($type, $request);
            case 'assessment_statement':
                return app(handleStatementRequestController::class)->handleStatementRequest($type, $request);
            case 'assessment_exam':
                return app(handleAssessmentExamRequestController::class)->handleExamRequest($type, $request);
            case 'exam':
                return app(HandleExamRequestController::class)->handleExamRequest($type, $request);
            case 'user_exam':
                return app(HandleUserExamRequestController::class)->handleUserExamRequest($type, $request);
            case 'live_tracking':
                return app(HandleLiveTrackingRequestController::class)->handleLiveTrackingRequest($type, $request);
            case 'exam_chapter':
                return app(HandleExamChapterRequestController::class)->handleChapterRequest($type, $request);
            case 'auth':
                return app(handleAuthRequestController::class)->handleAuthRequest($type, $request);
            default:
                return response()->json(['error' => 'Invalid mode'], 400);
        }
    }
}