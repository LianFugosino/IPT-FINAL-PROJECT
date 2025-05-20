<?php

use App\Http\Controllers\Api\ApiKeyController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\BorrowRecordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('users', UserController::class);
Route::resource('books', UserController::class);
Route::resource('borrow_records', BorrowRecordController::class);
Route::resource('api_keys', ApiKeyController::class);
