<?php

use App\Http\Controllers\FileController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/api/process-file', [FileController::class, 'index']);
    Route::post('/api/process-file', [FileController::class, 'process']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});