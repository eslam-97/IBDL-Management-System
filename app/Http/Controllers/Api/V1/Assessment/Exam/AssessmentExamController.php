<?php

namespace App\Http\Controllers\Api\V1\Assessment\Exam;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Assessment\Exam\StoreExamRequest;
use App\Http\Requests\Api\V1\Assessment\Exam\UpdateExamRequest;
use App\Http\Requests\Api\V1\Assessment\Category\UploadFileRequest;
use App\Http\Resources\Assessment\Exam\ExamResource;
use App\Repository\Assessment\Exam\AssessmentExamRepositoryInterface;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;


class AssessmentExamController extends Controller
{
    public function __construct(protected AssessmentExamRepositoryInterface $exam)
    {
    }

    public function index()
    {

        try {
            $data = $this->exam->getAllExams();
            $response = ExamResource::collection($data);
            $jsonResponse = $response->response()->getContent();

            return base64_encode($jsonResponse);

        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }


    public function store()
    {
        try {
            $data = $this->validate(request(), StoreExamRequest::rules());
            DB::transaction(function () use ($data) {
                $this->exam->storeExam($data);
            });

            return $this->successResponse([], 200);
        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function update()
    {
        try {
            $data = $this->validate(request(), UpdateExamRequest::rules());
            DB::transaction(function () use ($data) {
                $this->exam->updateExam($data);
            });

            return $this->successResponse([], 200);
        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function uploadAssessmentExam()
    {
        try {
            $data = $this->validate(request(), UploadFileRequest::rules());
            DB::transaction(function () use ($data) {
                $this->exam->uploadAssessmentExam($data);
            });

            return $this->successResponse([], 200);
        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show()
    {
        try {
            $data = $this->exam->showExam();
            $response = new ExamResource($data);
            $jsonResponse = $response->response()->getContent();

            return base64_encode($jsonResponse);

        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }


    public function destroy()
    {
        try {
            $this->exam->deleteExam();
            return $this->successResponse([], 200);

        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}