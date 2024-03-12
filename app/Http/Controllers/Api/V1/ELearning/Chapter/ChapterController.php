<?php

namespace App\Http\Controllers\Api\V1\ELearning\Chapter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\ELearning\Chapter\StoreChapterRequest;
use App\Http\Requests\Api\V1\ELearning\Chapter\UpdateChapterRequest;
use App\Http\Resources\ELearning\Chapter\ChapterResource;
use App\Repository\ELearning\Chapter\ChapterRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

class ChapterController extends Controller
{
    public function __construct(protected ChapterRepositoryInterface $chapter)
    {
    }

    public function index()
    {

        try {
            $data = $this->chapter->getAllChapter();

            $response = ChapterResource::collection($data);

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
            $data = $this->validate(request(), StoreChapterRequest::rules());

            DB::transaction(function () use ($data) {
                $this->chapter->storeChapter($data);
            });

            return $this->successResponse([], 200);
        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function update()
    {
        try {
            $data = $this->validate(request(), UpdateChapterRequest::rules());

            DB::transaction(function () use ($data) {
                $this->chapter->updateChapter($data);
            });

            return $this->successResponse([], 200);
        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function show()
    {
        try {
            $data = $this->chapter->showChapter();

            $response = new ChapterResource($data);

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
            $this->chapter->deleteChapter();
            return $this->successResponse([], 200);

        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
