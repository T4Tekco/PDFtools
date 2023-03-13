<?php
//convert
use App\Http\Controllers\ConversionController;
use App\Http\Controllers\PdfToexcelController;
use App\Http\Controllers\pdftxt;
use App\Http\Controllers\FileController;

// giao dien

use App\Http\Controllers\Convert\PdfToWordController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ConvertFilesController;

use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });


// Page convert
// Route::get('/main', [ConvertFilesController::class, 'main'])->name('main');
// Route::get('/', [ConvertFilesController::class, 'Convert'])->name('convert');


Route::get('/test/pdf-to-json', [pdftxt::class, 'index']);
// Route::get('/pdf-to-txt', [ConversionController::class, 'index']);

Route::post('/convert', [ConversionController::class, 'pdfToTxt'])->name('pdfToTxt');
Route::get('/pdf-to-json', 'App\Http\Controllers\FileController@index');
Route::post('/pdf-to-json', 'App\Http\Controllers\FileController@pdfToJson');

//convert pdf to txt
Route::post('/api/pdf-to-txt', 'App\Http\Controllers\FileController@pdfToTxt');
Route::get('/pdf-to-txt', 'App\Http\Controllers\FileController@txtojson');

//covert file pdf to word
Route::get('/api/pdf-to-word', [PdfToWordController::class, 'index']);
Route::post('/api/pdf-to-word', [PdfToWordController::class, 'txtToPdf']);

//covert file word to pdf
Route::get('/api/word-to-pdf', [PdfToWordController::class, 'index']);
Route::post('/api/word-to-pdf', [PdfToWordController::class, 'convertToPdf']);
//api 
Route::get('/api/process-file', [FileController::class, 'index']);
Route::post('/api/process-file', [FileController::class, 'process']);

// user
// account
Route::get('/login', [AccountController::class, 'Login'])->name('login');
Route::get('/signup', [AccountController::class, 'Signup'])->name('signup');
Route::get('/profile', [AccountController::class, 'Profile'])->name('profile');
//change pass and forgot pass
Route::get('/changepassword', [AccountController::class, 'ChangePass'])->name('change_pass');
Route::get('/forgotpass', [AccountController::class, 'ForgotPass'])->name('forgotpas');

Route::get('/aboutus', [AccountController::class, 'AboutUs'])->name('aboutus');
Route::get('/contact', [AccountController::class, 'Contact'])->name('contact');
// Page convert
// Route::get('/main', [ConvertFilesController::class, 'main'])->name('main');
Route::get('/', [ConvertFilesController::class, 'Convert'])->name('convert');