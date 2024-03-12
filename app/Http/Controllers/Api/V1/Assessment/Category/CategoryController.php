<?php

namespace App\Http\Controllers\Api\V1\Assessment\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Assessment\Category\StoreCategoryRequest;
use App\Http\Requests\Api\V1\Assessment\Category\UpdateCategoryRequest;
use App\Http\Requests\Api\V1\Assessment\Category\UploadFileRequest;
use App\Http\Resources\Assessment\Category\CategoryResource;
use App\Models\Category;
use App\Repository\Assessment\Category\CategoryRepositoryInterface;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;


class CategoryController extends Controller
{
    public function __construct(protected CategoryRepositoryInterface $category)
    {
    }

    public function index()
    {

        try {
            $data = $this->category->getAllCategorys();
            $response = CategoryResource::collection($data);
            $jsonResponse = $response->response()->getContent();

            return base64_encode($jsonResponse);

        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }


    public function store()
    {
        try {
            $data = $this->validate(request(), StoreCategoryRequest::rules());

            DB::transaction(function () use ($data) {
                $this->category->storeCategory($data);
            });

            return $this->successResponse([], 200);
        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function update()
    {
        try {
            $data = $this->validate(request(), UpdateCategoryRequest::rules());
            DB::transaction(function () use ($data) {
                $this->category->updateCategory($data);
            });

            return $this->successResponse([], 200);
        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function show()
    {
        try {
            $data = $this->category->showCategory();
            $response = new CategoryResource($data);
            $jsonResponse = $response->response()->getContent();

            return base64_encode($jsonResponse);

        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
    public function uploadAssessmentCategory()
    {
        try {
            $data = $this->validate(request(), UploadFileRequest::rules());
            DB::transaction(function () use ($data) {
                $this->category->uploadAssessmentCategory($data);
            });

            return $this->successResponse([], 200);
        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function destroy()
    {
        try {
            $this->category->deleteCategory();
            
            return $this->successResponse([], 200);

        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}