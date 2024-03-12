<?php

namespace App\Http\Controllers\Api\V1\Assessment\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Assessment\Company\StoreCompanyRequest;
use App\Http\Requests\Api\V1\Assessment\Company\UpdateCompanyRequest;
use App\Http\Resources\Assessment\Company\CompanyResource;
use App\Repository\Assessment\Company\CompanyRepositoryInterface;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;


class CompanyController extends Controller
{
    public function __construct(protected CompanyRepositoryInterface $company)
    {
    }

    public function index()
    {

        try {
            $data = $this->company->getAllCompanys();
            $response = CompanyResource::collection($data);
            $jsonResponse = $response->response()->getContent();

            return base64_encode($jsonResponse);

        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }


    public function store()
    {
        try {
            $data = $this->validate(request(), StoreCompanyRequest::rules());
            DB::transaction(function () use ($data) {
                $this->company->storeCompany($data);
            });

            return $this->successResponse([], 200);
        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function update()
    {
        try {
            $data = $this->validate(request(), UpdateCompanyRequest::rules());
            DB::transaction(function () use ($data) {
                $this->company->updateCompany($data);
            });

            return $this->successResponse([], 200);
        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function show()
    {
        try {
            $data = $this->company->showCompany();
            $response = new CompanyResource($data);
            $jsonResponse = $response->response()->getContent();

            return base64_encode($jsonResponse);

        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }


    public function destroy()
    {
        try {
            $this->company->deleteCompany();
            return $this->successResponse([], 200);

        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}