<?php

namespace App\Http\Controllers\Api\V1\Exam;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Exam\StoreExamRequest;
use App\Http\Requests\Api\V1\Exam\UpdateExamRequest;
use App\Http\Requests\Api\V1\Exam\UploadExamDataRequest;
use App\Http\Resources\Exam\ExamResource;
use App\Repository\Exam\ExamRepositoryInterface;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{
    public function __construct(protected ExamRepositoryInterface $exam)
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

    public function uploadExamData()
    {
        try {
            $data = $this->validate(request(), UploadExamDataRequest::rules());
            DB::transaction(function () use ($data) {
                $this->exam->uploadExamData($data);
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