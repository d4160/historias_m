<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\YabajaAPI;

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

Route::group(['middleware' => 'auth:sanctum'], function(){
    //All secure URL's
    Route::get('data/{id?}', [YabajaAPI::class, 'getData']);
    Route::post('upload', [YabajaAPI::class, 'uploadFile']);
    Route::post('uploadBin', [YabajaAPI::class, 'uploadBin']);
});

//Route::middleware('auth:sanctum')->get('/data/{id?}', [YabajaAPI::class, 'getData']);

Route::post("login",[UserController::class,'index']);


