<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AppDatasController;
use App\Http\Controllers\Api\LawDatasController;
use App\Http\Controllers\Api\AuthController;

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

//Route::get('chkAllApp',[AppDatasController::class,'chkAllApp']);

Route::middleware(['auth:api'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth.api')->group(function () {
        Route::get('/me', [AuthController::class, 'me']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh']);

    Route::get('chkAllApp',[AppDatasController::class,'chkAllApp']);
    Route::get('ListAllApp',[AppDatasController::class,'ListAllApp']);
    Route::get('chkAppVersion/{appid}',[AppDatasController::class,'chkAppVersion']);
    Route::get('getAllLawData/{appid}',[LawDatasController::class,'getAllLawData']);
    Route::get('getAllLawCategory/{appid}',[LawDatasController::class,'getAllLawCategory']);
    Route::get('getDekaMap/{appid}',[LawDatasController::class,'getDekaMap']);
    Route::get('getDekaData/{appid}',[LawDatasController::class,'getDekaData']);

    });

});
