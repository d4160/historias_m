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
    //Route::get('data/{id?}', [YabajaAPI::class, 'getData']);
    Route::post('upload/exam/report', [YabajaAPI::class, 'uploadPdfReport']);
    Route::post('upload/exam/report/{id}', [YabajaAPI::class, 'uploadPdfReport2']);
    Route::get('search/exams/{dni}', [YabajaAPI::class, 'searchExams']);
    Route::get('search/attentions/{dni}', [YabajaAPI::class, 'searchAttentions']);
    Route::post('save/dicom', [YabajaAPI::class, 'saveDICOM']);
});

//Route::get('data2/{id?}', [YabajaAPI::class, 'getData']);
//Route::middleware('auth:sanctum')->get('/data/{id?}', [YabajaAPI::class, 'getData']);

Route::post("login",[UserController::class,'index']);


