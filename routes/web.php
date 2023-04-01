<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoController;

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

Route::get('/', [ VideoController::class, 'index' ])->name('list.video');
Route::get('video-upload', [ VideoController::class, 'getVideoUploadForm' ])->name('get.video.upload');
Route::post('video-upload', [ VideoController::class, 'uploadVideo' ])->name('store.video');
Route::get('video-upload/{id}', [ VideoController::class, 'view' ])->name('view.video');
Route::get('video-upload/edit/{id}', [ VideoController::class, 'edit' ])->name('edit.video');
Route::post('video-upload/{id}', [ VideoController::class, 'update' ])->name('update.video');
Route::delete('video-upload/delete/{id}', [ VideoController::class, 'delete' ])->name('delete.video');
