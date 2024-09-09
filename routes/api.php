<?php

use App\Http\Controllers\Api\ContactMailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource("users", UserController::class);
Route::apiResource("contacts", ContactMailController::class);
