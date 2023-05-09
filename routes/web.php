<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\ConvertFilesController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PDFtoWordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\WordtoPDFController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

Route::get('language/{locate}', function ($locate) {
    if (!in_array($locate, ['en', 'vi'])) {
        abort(404);
    }
    session()->put('locate', $locate);
    return redirect()->back();
});
// account
Route::get('/login', [AccountController::class, 'Login'])->name('login');
Route::get('/signup', [AccountController::class, 'Signup'])->name('signup');
Route::get('/profile', [AccountController::class, 'Profile'])->name('profile');
//change pass and forgot pass
Route::get('/changepassword', [AccountController::class, 'ChangePass'])->name('change_pass');
Route::get('/forgotpass', [AccountController::class, 'ForgotPass'])->name('forgotpas');

Route::get('/aboutus', [AccountController::class, 'AboutUs'])->name('aboutus');
Route::get('/contact', [AccountController::class, 'Contact'])->name('contact');
Route::get('/tool', [AccountController::class, 'Tool'])->name('tool');

Route::get('/', [ConvertFilesController::class, 'Convert'])->name('convert');
Route::get('/policy', [AccountController::class, 'policy'])->name('policy');
Route::get('/term', [AccountController::class, 'term'])->name('term');

Route::get('/QRURL', [AccountController::class, 'QR_Code_url'])->name('QR_Code_url');
Route::get('/QRVcrad', [AccountController::class, 'QR_Code'])->name('QR_Code');
