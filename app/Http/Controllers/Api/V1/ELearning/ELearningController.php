<?php

namespace App\Http\Controllers\Api\V1\ELearning;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\ELearning\StoreELearningRequest;
use App\Http\Requests\Api\V1\ELearning\UpdateELearningRequest;
use App\Http\Resources\ELearning\ELearningResource;
use Exception;
use App\Repository\ELearning\ELearningRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

class ELearningController extends Controller
{
    public function __construct(protected ELearningRepositoryInterface $eLearning)
    {
    }
    public function index()
    {

        try {
            $data = $this->eLearning->getAllELearning();

            $response = ELearningResource::collection($data);

            // Convert the response to JSON and then encode it as base64
            $jsonResponse = $response->response()->getContent();

            // Encode the JSON response as base64
            return base64_encode($jsonResponse);

        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function store()
    {
        try {
            $data = $this->validate(request(), StoreELearningRequest::rules());

            DB::transaction(function () use ($data) {
                $this->eLearning->storeELearning($data);
            });

            return $this->successResponse([], 200);
        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function update()
    {
        try {
            $data = $this->validate(request(), UpdateELearningRequest::rules());

            DB::transaction(function () use ($data) {
                $this->eLearning->updateELearning($data);
            });

            return $this->successResponse([], 200);
        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function show()
    {
        try {
            $data = $this->eLearning->showELearning();

            $response = new ELearningResource($data);

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
            $this->eLearning->deleteELearning();
            return $this->successResponse([], 200);

        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
