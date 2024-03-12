<?php

namespace App\Http\Controllers\Api\V1\Exam\Chapter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Exam\Chapter\StoreChapterRequest;
use App\Http\Requests\Api\V1\Exam\Chapter\UpdateChapterRequest;
use App\Http\Resources\Exam\Chapter\ChapterResource;
use App\Repository\Exam\Chapter\ExamChapterRepositoryInterface;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ExamChapterController extends Controller
{
    public function __construct(protected ExamChapterRepositoryInterface $chapter)
    {
    }

    public function index()
    {
        try {
            $data = $this->chapter->getAllChapters();
            $response = ChapterResource::collection($data);
            $jsonResponse = $response->response()->getContent();

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