<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class GetAuthUser extends Controller
{

    public function __invoke()
    {
        try {
            $user = Auth::guard('api')->user();
            $user->load('roles');

            $response = new UserResource($user);

            // Convert the response to JSON and then encode it as base64
            $jsonResponse = $response->response()->getContent();

            // Encode the JSON response as base64
            return base64_encode($jsonResponse);

        } catch (Exception $e) {

            return $this->errorResponse('An error occurred: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}