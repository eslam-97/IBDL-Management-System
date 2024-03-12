<?php

namespace App\Http\Controllers\Api\V1\AccreditationCenter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\AccreditationCenter\StoreAccreditationCenterRequest;
use App\Http\Requests\Api\V1\AccreditationCenter\UpdateAccreditationCenterRequest;
use App\Http\Resources\AccreditationCenter\AccreditationCenterResource;
use App\Repository\AccreditationCenter\AccreditationCenterRepositoryInterface;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;


class AccreditationCenterController extends Controller
{
    public function __construct(protected AccreditationCenterRepositoryInterface $accreditationCenter)
    {
    }

    public function index()
    {

        try {
            $data = $this->accreditationCenter->getAllAccreditationCenter();

            $response = AccreditationCenterResource::collection($data);

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
            $data = $this->validate(request(), StoreAccreditationCenterRequest::rules());

            DB::transaction(function () use ($data) {
                $this->accreditationCenter->storeAccreditationCenter($data);
            });

            return $this->successResponse([], 200);
        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update()
    {
        try {
            $data = $this->validate(request(), UpdateAccreditationCenterRequest::rules());

            DB::transaction(function () use ($data) {
                $this->accreditationCenter->updateAccreditationCenter($data);
            });

            return $this->successResponse([], 200);
        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }



    public function show()
    {

        try {
            $data = $this->accreditationCenter->showAccreditationCenter();

            $response = new AccreditationCenterResource($data);

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
            $this->accreditationCenter->deleteAccreditationCenter();
            return $this->successResponse([], 200);

        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}