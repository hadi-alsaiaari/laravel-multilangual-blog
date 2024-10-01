<?php

use App\Http\Controllers\Website\IndexController;
use App\Http\Controllers\Website\PostController;
use App\Http\Controllers\Website\CategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('category');
Route::get('/post/{post}', [PostController::class, 'show'])->name('post');

require __DIR__.'/auth.php';

require __DIR__.'/dashboard.php';
