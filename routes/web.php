<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SignUpController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::get('/changepassword', [ChangePasswordController::class, 'ChangePas'])->name('change_pass');
Route::get('/home', [HomeController::class, 'Home'])->name('home');
Route::get('/profile', [ProfileController::class, 'Profile'])->name('profile');
Route::get('/signup', [SignUpController::class, 'Signup'])->name('signup');
Route::get('/forgotpass', [ForgotPasswordController::class, 'ForgotPas'])->name('forgotpas');

