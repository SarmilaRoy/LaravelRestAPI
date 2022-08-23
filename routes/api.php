<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserApiController;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//get api for fetch user
Route::get('/users/{id?}',[UserApiController::class,'showData']);
//post api for add user
Route::post('/add-users',[UserApiController::class,'addUser']);
//post api for multiple add user
Route::post('/add-multiple-users',[UserApiController::class,'addMultipleUser']);
