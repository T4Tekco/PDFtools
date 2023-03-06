<?php
//convert
use App\Http\Controllers\ConversionController;
use App\Http\Controllers\PdfToexcelController;
use App\Http\Controllers\pdftxt;
use App\Http\Controllers\FileController;

// giao dien
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\Convert\PdfToWordController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SignUpController;
// api
use App\Http\Controllers\UserAPi;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});


// Page convert
// Route::get('/main', [ConvertFilesController::class, 'main'])->name('main');
Route::get('/', [ConvertFilesController::class, 'Convert'])->name('convert');


Route::get('/test/pdf-to-json', [pdftxt::class, 'index']);
// Route::get('/pdf-to-txt', [ConversionController::class, 'index']);

Route::post('/convert', [ConversionController::class, 'pdfToTxt'])->name('pdfToTxt');
Route::get('/pdf-to-json', 'App\Http\Controllers\FileController@index');
Route::post('/pdf-to-json', 'App\Http\Controllers\FileController@pdfToJson');

//convert pdf to txt
Route::post('/pdf-to-txt', 'App\Http\Controllers\FileController@pdfToTxt');
Route::get('/txt-to-json', 'App\Http\Controllers\FileController@txtojson');

Route::get('pdf-to-excel', [PdfToexcelController::class, 'index']);
Route::post('pdf-to-excel', [PdfToexcelController::class, 'convert']);
//covert file pdf to word
Route::get('/pdf-to-word', [PdfToWordController::class, 'index']);
Route::post('/pdf-to-word', [PdfToWordController::class, 'convertFileToWord']);
//api 
Route::get('/api/process-file', [FileController::class, 'index']);
Route::post('/api/process-file', [FileController::class, 'process']);

// user to web api 
Route::get('/api/user', [UserAPi::class, 'index']);
Route::post('/api/user', [UserAPi::class, 'sumbitapi']);

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::get('/changepassword', [ChangePasswordController::class, 'ChangePas'])->name('change_pass');
Route::get('/home', [HomeController::class, 'Home'])->name('home');
Route::get('/profile', [ProfileController::class, 'Profile'])->name('profile');
Route::get('/signup', [SignUpController::class, 'Signup'])->name('signup');
Route::get('/forgotpass', [ForgotPasswordController::class, 'ForgotPas'])->name('forgotpas');
