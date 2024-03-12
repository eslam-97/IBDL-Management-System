<?php

namespace App\Http\Controllers\Api\V1\Corporate\Batch;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Corporate\Batch\StoreBatchRequest;
use App\Http\Requests\Api\V1\Corporate\Batch\UpdateBatchRequest;
use App\Http\Resources\Corporate\Batch\BatchResource;
use App\Models\Batch;
use App\Repository\Corporate\Batch\BatchRepositoryInterface;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;


class BatchController extends Controller
{
    public function __construct(protected BatchRepositoryInterface $batch)
    {
    }

    public function index()
    {

        try {
            $data = $this->batch->getAllBatchs();

            $response = BatchResource::collection($data);

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
            $data = $this->validate(request(), StoreBatchRequest::rules());

            DB::transaction(function () use ($data) {
                $this->batch->storeBatch($data);
            });

            return $this->successResponse([], 200);
        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function update()
    {
        try {
            $data = $this->validate(request(), UpdateBatchRequest::rules());

            DB::transaction(function () use ($data) {
                $this->batch->updateBatch($data);
            });

            return $this->successResponse([], 200);
        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function show()
    {
        try {
            $data = $this->batch->showBatch();

            $response = new BatchResource($data);

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
            $this->batch->deleteBatch();
            return $this->successResponse([], 200);

        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}