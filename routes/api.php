<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\NoteController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:sanctum')->group(function(){
    Route::post('/auth/register',[UserController::class,'createUser']);
    Route::post('/auth/login',[UserController::class,'loginUser']);
});

Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('/note', NoteController::class);
    Route::post('/auth/logout',[UserController::class,'logout']);
});
