<?php

namespace App\Http\Controllers\Api\V1\Corporate;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Corporate\StoreCorporateRequest;
use App\Http\Requests\Api\V1\Corporate\UpdateCorporateRequest;
use App\Http\Resources\Corporate\CorporateResource;
use App\Models\Corporate;
use App\Repository\Corporate\CorporateRepositoryInterface;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;


class CorporateController extends Controller
{
    public function __construct(protected CorporateRepositoryInterface $corporate)
    {
    }


    public function index()
    {

        try {
            $data = $this->corporate->getAllCorporates();

            $response = CorporateResource::collection($data);

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
            $data = $this->validate(request(), StoreCorporateRequest::rules());

            DB::transaction(function () use ($data) {
                $this->corporate->storeCorporate($data);
            });

            return $this->successResponse([], 200);
        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function update()
    {
        try {
            $data = $this->validate(request(), UpdateCorporateRequest::rules());

            DB::transaction(function () use ($data) {
                $this->corporate->updateCorporate($data);
            });

            return $this->successResponse([], 200);
        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function show()
    {
        try {
            $data = $this->corporate->showCorporate();

            $response = new CorporateResource($data);

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
            $this->corporate->deleteCorporate();
            return $this->successResponse([], 200);

        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}