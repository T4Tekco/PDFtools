<?php
//convert
use App\Http\Controllers\ConversionController;
use App\Http\Controllers\pdftxt;
use App\Http\Controllers\FileController;

// giao dien
use App\Http\Controllers\Convert\PdfToWordController;
use App\Http\Controllers\homeapge;
use Illuminate\Support\Facades\Route;
use InitRed\Tabula\Tabula;

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
//admin
// Route::get('/admin', [homeAdmin::class, 'index']);
// Route::get('/admin/profile', [accountAdmin::class, 'index']);

// Route::get('language/{locate}', function ($locate) {
//   if (!in_array($locate, ['en', 'vi'])) {
//     abort(404);
//   }
//   session()->put('locate', $locate);
//   return redirect()->back();
// });
// // account
// Route::get('/login', [AccountController::class, 'Login'])->name('Login');
// Route::post('/login', [AccountController::class, 'postlogin']);
// Route::get('/signup', [AccountController::class, 'Signup'])->name('signup');
// Route::get('/profile', [AccountController::class, 'Profile'])->name('profile');
// //change pass and forgot pass
// Route::get('/changepassword', [AccountController::class, 'ChangePass'])->name('change_pass');
// Route::get('/forgotpass', [AccountController::class, 'ForgotPass'])->name('forgotpas');

// Route::get('/aboutus', [AccountController::class, 'AboutUs'])->name('aboutus');
// Route::get('/contact', [AccountController::class, 'Contact'])->name('contact');
// Route::get('/tool', [AccountController::class, 'Tool'])->name('tool');

Route::get('/', [homeapge::class, 'Homepage'])->name('Homepage');
// Route::get('/home', [ConvertFilesController::class, 'Convert'])->name('convert');
// Route::get('/policy', [AccountController::class, 'policy'])->name('policy');
// Route::get('/term', [AccountController::class, 'term'])->name('term');
// Route::get('/logout', function () {
//   session_start();
//   session_unset();
//   header("location: /");
// });

// convert file
Route::get('/test/pdf-to-json', [pdftxt::class, 'index']);
Route::get('/test', [pdftxt::class, 'convertfilepdfencode']);
Route::get('/testform', function () {
  $file = storage_path('app/public/pdf/te.pdf');

  $tabula = new Tabula('C:/Program Files/Java/jre1.8.0_361/bin/java.exe');
  
  $tabula->setPdf($file)
      ->setOptions([
          'format' => 'csv',
          'pages' => 'all',
          'lattice' => true,
          'stream' => true,
          'outfile' => storage_path("app/public/csv/test.csv"),
      ])
      ->convert();
});
Route::post('/testform', [pdftxt::class, 'convertPdfToText']);
// Route::get('/pdf-to-txt', [ConversionController::class, 'index']);

Route::post('/convert', [ConversionController::class, 'pdfToTxt'])->name('pdfToTxt');
Route::get('/pdf-to-json', 'App\Http\Controllers\FileController@index');
Route::post('/pdf-to-json', 'App\Http\Controllers\FileController@pdfToJson');

//convert pdf to txt
Route::post('/api/pdf-to-txt', [pdftxt::class, 'convertPdfToText']);
Route::get('/api/pdf-to-txt', [pdftxt::class, 'index']);
//convert txt to json
Route::post('/api/txt-to-json', [pdftxt::class, 'convertToJson']);
Route::get('/api/txt-to-json', [pdftxt::class, 'index']);
//covert file pdf to json
Route::post('/api/pdf-to-jsont', [pdftxt::class, 'convertToJsontest']);
//covert file word to pdf
Route::get('/api/word-to-pdf', [PdfToWordController::class, 'index']);
Route::post('/api/word-to-pdf', [PdfToWordController::class, 'convertToPdf']);

Route::get('/api/process-file', [FileController::class, 'index']);
Route::post('/api/process-file', [FileController::class, 'process']);
