<?php

use App\Http\Controllers\convert\ImgToText;
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



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/ImgToText',[ImgToText::class,'convertImgToText_'])->name('img-to-text');
Route::post('/base64/ImgToText',[ImgToText::class,'convertImgToTextBase64_'])->name('img-base64-to-text');