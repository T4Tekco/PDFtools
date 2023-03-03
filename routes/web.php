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

