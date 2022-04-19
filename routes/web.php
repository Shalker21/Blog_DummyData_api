<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\Api_Call_Controller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PostController::class, 'index'])->name('posts.index');

Route::get('/api', [Api_Call_Controller::class, 'index'])->name('api_call.index');
Route::get('/api/api_call', [Api_Call_Controller::class, 'store_data'])->name('api_call');
