<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Ver1\TodoController;
use App\Http\Controllers\Api\Ver1\AuthController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API Version 1 Routes
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\Ver1'], function () {
    Route::apiResource('todos', TodoController::class);
    Route::apiResource('auth', AuthController::class);
});