<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;

Route::post('/messages', [MessageController::class, 'sendMessage'])->middleware('auth:api');
Route::get('/messages/{chatId}', [MessageController::class, 'fetchMessages'])->middleware('auth:api');

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
