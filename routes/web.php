<?php

use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/file', [UploadController::class,'upload'])->name('file upload');
Route::post('/file', [UploadController::class, 'store'])->name('uploadImage'); 
Route::get('/file/{id}', [UploadController::class, 'destroy'])->name('deleteImage');