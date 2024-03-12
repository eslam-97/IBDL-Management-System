<?php

namespace App\Http\Controllers\Api\V1\Exam\UserExam;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Exam\UserExam\StoreUserExamRequest;
use App\Http\Requests\Api\V1\Exam\UserExam\UpdateUserExamRequest;
use App\Http\Resources\Exam\UserExam\UserExamResource;
use App\Repository\Exam\UserExam\UserExamRepositoryInterface;
use DB;
use Illuminate\Http\Response;
use Exception;

class UserExamController extends Controller
{
    public function __construct(protected UserExamRepositoryInterface $userExam)
    {
    }

    public function index()
    {
        try {
            $data = $this->userExam->getAllUserExams();
            $response = UserExamResource::collection($data);
            $jsonResponse = $response->response()->getContent();

            return base64_encode($jsonResponse);

        } catch (Exception $e) {
            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store()
    {
        try {
            $data = $this->validate(request(), StoreUserExamRequest::rules());

            DB::transaction(function () use ($data) {
                $this->userExam->storeUserExam($data);
            });

            return $this->successResponse([], 200);
        } catch (Exception $e) {
            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update()
    {
        try {
            $data = $this->validate(request(), UpdateUserExamRequest::rules());

            DB::transaction(function () use ($data) {
                $this->userExam->updateUserExam($data);
            });

            return $this->successResponse([], 200);
        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show()
    {
        try {
            $data = $this->userExam->showUserExam();

            $response = new UserExamResource($data);

            // Convert the response to JSON and then encode it as base64
            $jsonResponse = $response->response()->getContent();

            return base64_encode($jsonResponse);

        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy()
    {
        try {
            $this->userExam->deleteUserExam();

            return $this->successResponse([], 200);

        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}