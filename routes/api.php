<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

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

//public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/users', [AuthController::class, 'showUser']);
Route::get('/post',[PostController::class,'index']);
Route::get('/post/{id}',[PostController::class,'show']);

//protected Routes
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('post',[PostController::class, 'viewAllPost']);
    Route::post('post',[PostController::class, 'createPost']);
    Route::get('searchPost/{slug}', [PostController::class, 'searchPost']);
    Route::put('updatePost/{id}',[PostController::class, 'editPost']);
    Route::get('deletePost/{id}',[PostController::class, 'deletePost']);
});
