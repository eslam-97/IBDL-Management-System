<?php

use App\Http\Controllers\Api\V1\IBDLController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('/IBDL', [IBDLController::class, 'handleIBDLRequest']);
