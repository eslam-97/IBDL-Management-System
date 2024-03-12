<?php

namespace App\Http\Controllers\Api\V1\Assessment\Position;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Assessment\Position\StorePositionRequest;
use App\Http\Requests\Api\V1\Assessment\Position\UpdatePositionRequest;
use App\Http\Resources\Assessment\Position\PositionResource;
use App\Repository\Assessment\Position\PositionRepositoryInterface;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;


class PositionController extends Controller
{
    public function __construct(protected PositionRepositoryInterface $position)
    {
    }

    public function index()
    {

        try {
            $data = $this->position->getAllPositions();
            $response = PositionResource::collection($data);
            $jsonResponse = $response->response()->getContent();

            return base64_encode($jsonResponse);

        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function store()
    {
        try {
            $data = $this->validate(request(), StorePositionRequest::rules());
            DB::transaction(function () use ($data) {
                $this->position->storePosition($data);
            });

            return $this->successResponse([], 200);
        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update()
    {
        try {
            $data = $this->validate(request(), UpdatePositionRequest::rules());
            DB::transaction(function () use ($data) {
                $this->position->updatePosition($data);
            });

            return $this->successResponse([], 200);
        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show()
    {
        try {
            $data = $this->position->showPosition();
            $response = new PositionResource($data);
            $jsonResponse = $response->response()->getContent();

            return base64_encode($jsonResponse);

        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function destroy()
    {
        try {
            $this->position->deletePosition();
            return $this->successResponse([], 200);

        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}