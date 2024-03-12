<?php

namespace App\Http\Controllers\Api\V1\Assessment\Advice;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Assessment\Advice\StoreAdviceRequest;
use App\Http\Requests\Api\V1\Assessment\Advice\UpdateAdviceRequest;
use App\Http\Requests\Api\V1\Assessment\Category\UploadFileRequest;
use App\Http\Resources\Assessment\Advice\AdviceResource;
use App\Repository\Assessment\Advice\AdviceRepositoryInterface;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;


class AdviceController extends Controller
{
    public function __construct(protected AdviceRepositoryInterface $advice)
    {
    }

    public function index()
    {

        try {
            $data = $this->advice->getAllAdvices();
            $response = AdviceResource::collection($data);
            $jsonResponse = $response->response()->getContent();

            return base64_encode($jsonResponse);
        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }


    public function store()
    {
        try {
            $data = $this->validate(request(), StoreAdviceRequest::rules());
            DB::transaction(function () use ($data) {
                $this->advice->storeAdvice($data);
            });

            return $this->successResponse([], 200);
        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function update()
    {
        try {
            $data = $this->validate(request(), UpdateAdviceRequest::rules());
            DB::transaction(function () use ($data) {
                $this->advice->updateAdvice($data);
            });

            return $this->successResponse([], 200);
        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function uploadAssessmentAdvice()
    {
        try {
            $data = $this->validate(request(), UploadFileRequest::rules());
            DB::transaction(function () use ($data) {
                $this->advice->uploadAssessmentAdvice($data);
            });

            return $this->successResponse([], 200);
        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function show()
    {
        try {
            $data = $this->advice->showAdvice();
            $response = new AdviceResource($data);
            $jsonResponse = $response->response()->getContent();

            return base64_encode($jsonResponse);

        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }


    public function destroy()
    {
        try {
            $this->advice->deleteAdvice();

            return $this->successResponse([], 200);

        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}