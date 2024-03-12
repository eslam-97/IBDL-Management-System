<?php

namespace App\Http\Controllers\Api\V1\AccreditationCenter\AccreditationTrainer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\AccreditationCenter\AccreditationTrainer\StoreAccreditationTrainerRequest;
use App\Http\Requests\Api\V1\AccreditationCenter\AccreditationTrainer\UpdateAccreditationTrainerRequest;
use App\Http\Resources\AccreditationCenter\AccreditationTrainer\AccreditationTrainerResource;
use App\Repository\AccreditationCenter\AccreditationTrainer\AccreditationTrainerRepositoryInterface;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;


class AccreditationTrainerController extends Controller
{
    public function __construct(protected AccreditationTrainerRepositoryInterface $accreditationTrainer)
    {
    }

    public function index()
    {

        try {
            $data = $this->accreditationTrainer->getAllAccreditationTrainer();

            $response = AccreditationTrainerResource::collection($data);

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
            $data = $this->validate(request(), StoreAccreditationTrainerRequest::rules());

            DB::transaction(function () use ($data) {
                $this->accreditationTrainer->storeAccreditationTrainer($data);
            });

            return $this->successResponse([], 200);
        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update()
    {
        try {
            $data = $this->validate(request(), UpdateAccreditationTrainerRequest::rules());

            DB::transaction(function () use ($data) {
                $this->accreditationTrainer->updateAccreditationTrainer($data);
            });

            return $this->successResponse([], 200);
        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }



    public function show()
    {

        try {
            $data = $this->accreditationTrainer->showAccreditationTrainer();

            $response = new AccreditationTrainerResource($data);

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
            $this->accreditationTrainer->deleteAccreditationTrainer();
            return $this->successResponse([], 200);

        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}