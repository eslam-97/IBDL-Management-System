<?php

namespace App\Http\Controllers\Api\V1\Exam\LiveTracking;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Exam\LiveTracking\LiveTrackingRequest;
use App\Http\Resources\Exam\LiveTracking\LiveTrackingResource;
use App\Repository\Exam\LiveTracking\LiveTrackingRepositoryInterface;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class LiveTrackingController extends Controller
{

    public function __construct(protected LiveTrackingRepositoryInterface $liveTracking)
    {
    }

    public function index()
    {
        try {
            $data = $this->liveTracking->getAllLiveTrackings();

            $response = LiveTrackingResource::collection($data);

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
            $data = $this->validate(request(), LiveTrackingRequest::rules());

            DB::transaction(function () use ($data) {
                $this->liveTracking->storeLiveTracking($data);
            });

            return $this->successResponse([], 200);
        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show()
    {

        try {
            $data = $this->liveTracking->showLiveTracking();

            $response = new LiveTrackingResource($data);

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
            $this->liveTracking->deleteLiveTracking();
            return $this->successResponse([], 200);

        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}