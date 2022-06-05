<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;


Route::get('/',[PostController::class,'index']);

Route::post('register',[PostController::class,'store']);

Route::post('login',[PostController::class,'login']);

Route::get('getstudent/{id}',[PostController::class,'show']);

Route::put('student/{id}/update',[PostController::class,'update']);

Route::delete('student/{id}/delete',[PostController::class,'destroy']);


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
