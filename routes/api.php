<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;

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

Route::prefix('messages')->group(function () {
    // Store a new message
    Route::post('/', [MessageController::class, 'store']);

    // Get a message by ID
    Route::get('/{id}', [MessageController::class, 'get'])->where('id', '[0-9]+');

    // Delete a message by ID
    Route::delete('/{id}', [MessageController::class, 'delete'])->where('id', '[0-9]+');

    // Read a message with decryption key
    Route::post('/{id}/read', [MessageController::class, 'read'])->where('id', '[0-9]+');

});