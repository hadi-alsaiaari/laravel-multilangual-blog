<?php

use App\Http\Controllers\Api\AccessTokensController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function(){
    return 5;
});

Route::get('/settings', [SettingController::class, 'index'])->middleware('auth:sanctum');
Route::get('/nav-categories', [CategoryController::class, 'navbarCategories']);
Route::get('/index-page-categories', [CategoryController::class, 'indexPageCategoriesWithPosts']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{category}', [CategoryController::class, 'show']);

Route::apiResource('/posts', PostController::class)->only('index', 'show');

Route::post('auth/access-tokens', [AccessTokensController::class, 'login'])
    ->middleware('guest:sanctum');
Route::delete('auth/access-tokens/{token?}', [AccessTokensController::class, 'logout'])
    ->middleware('auth:sanctum');