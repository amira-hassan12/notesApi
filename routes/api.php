<?php
use Illuminate\Http\Request;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;


Route::post('/auth/register',[UserController::class,'createUser']);
Route::post('/auth/login',[UserController::class,'loginUser']);
Route::post('/auth/logout',[UserController::class,'logout'])->middleware('auth:sanctum');

