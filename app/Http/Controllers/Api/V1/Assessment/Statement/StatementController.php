<?php

namespace App\Http\Controllers\Api\V1\Assessment\Statement;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Assessment\Statement\StoreStatementRequest;
use App\Http\Requests\Api\V1\Assessment\Statement\UpdateStatementRequest;
use App\Http\Requests\Api\V1\Assessment\Category\UploadFileRequest;
use App\Http\Resources\Assessment\Statement\StatementResource;
use App\Repository\Assessment\Statement\StatementRepositoryInterface;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;


class StatementController extends Controller
{
    public function __construct(protected StatementRepositoryInterface $statement)
    {
    }

    public function index()
    {

        try {
            $data = $this->statement->getAllStatements();
            $response = StatementResource::collection($data);
            $jsonResponse = $response->response()->getContent();

            return base64_encode($jsonResponse);

        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function store()
    {
        try {
            $data = $this->validate(request(), StoreStatementRequest::rules());
            DB::transaction(function () use ($data) {
                $this->statement->storeStatement($data);
            });

            return $this->successResponse([], 200);
        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update()
    {
        try {
            $data = $this->validate(request(), UpdateStatementRequest::rules());
            DB::transaction(function () use ($data) {
                $this->statement->updateStatement($data);
            });

            return $this->successResponse([], 200);
        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function uploadAssessmentStatement()
    {
        try {
            $data = $this->validate(request(), UploadFileRequest::rules());
            DB::transaction(function () use ($data) {
                $this->statement->uploadAssessmentStatement($data);
            });

            return $this->successResponse([], 200);
        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show()
    {
        try {
            $data = $this->statement->showStatement();
            $response = new StatementResource($data);
            $jsonResponse = $response->response()->getContent();

            return base64_encode($jsonResponse);

        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function destroy()
    {
        try {
            $this->statement->deleteStatement();
            return $this->successResponse([], 200);

        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}