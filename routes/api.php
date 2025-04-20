<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AppDatasController;
use App\Http\Controllers\Api\LawDatasController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('chkAllApp',[AppDatasController::class,'chkAllApp']);
    Route::get('ListAllApp',[AppDatasController::class,'ListAllApp']);
    Route::get('chkAppVersion/{appid}',[AppDatasController::class,'chkAppVersion']);
    Route::get('getAllLawData/{appid}',[LawDatasController::class,'getAllLawData']);
    Route::get('getAllLawCategory/{appid}',[LawDatasController::class,'getAllLawCategory']);
    Route::get('getDekaMap/{appid}',[LawDatasController::class,'getDekaMap']);
    Route::get('getDekaData/{appid}',[LawDatasController::class,'getDekaData']);
});


