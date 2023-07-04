<?php
//convert
use App\Http\Controllers\ConversionController;
use App\Http\Controllers\pdftxt;
use App\Http\Controllers\FileController;

// giao dien
use App\Http\Controllers\AccountController;
use App\Http\Controllers\admin\accountAdmin;
use App\Http\Controllers\admin\homeAdmin;
use App\Http\Controllers\Convert\PdfToWordController;
use App\Http\Controllers\ConvertFilesController;
use App\Http\Controllers\homeapge;
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
//admin
Route::get('/admin', [homeAdmin::class, 'index']);
Route::get('/admin/profile', [accountAdmin::class, 'index']);

Route::get('language/{locate}', function ($locate) {
  if (!in_array($locate, ['en', 'vi'])) {
    abort(404);
  }
  session()->put('locate', $locate);
  return redirect()->back();
});
// account
Route::get('/login', [AccountController::class, 'Login'])->name('Login');
Route::post('/login', [AccountController::class, 'postlogin']);
Route::get('/signup', [AccountController::class, 'Signup'])->name('signup');
Route::get('/profile', [AccountController::class, 'Profile'])->name('profile');
//change pass and forgot pass
Route::get('/changepassword', [AccountController::class, 'ChangePass'])->name('change_pass');
Route::get('/forgotpass', [AccountController::class, 'ForgotPass'])->name('forgotpas');

Route::get('/aboutus', [AccountController::class, 'AboutUs'])->name('aboutus');
Route::get('/contact', [AccountController::class, 'Contact'])->name('contact');
Route::get('/tool', [AccountController::class, 'Tool'])->name('tool');

Route::get('/', [homeapge::class, 'Homepage'])->name('Homepage');
Route::get('/home', [ConvertFilesController::class, 'Convert'])->name('convert');
Route::get('/policy', [AccountController::class, 'policy'])->name('policy');
Route::get('/term', [AccountController::class, 'term'])->name('term');
Route::get('/logout', function () {
  session_start();
  session_unset();
  header("location: /");
});

// convert file
Route::get('/test/pdf-to-json', [pdftxt::class, 'index']);
Route::get('/test', [pdftxt::class, 'convertfilepdfencode']);
Route::get('/testform', function () {
  $line = [
    "4. Địa chỉ trụ sở chính:18 - MANOR 1 STR - SUNRISE A - Khu đô thị The Manor Central Park – Khu đô",
    "thị Nam đường vành đai 3, Phường Đại Kim, Quận Hoàng Mai, Thành phố Hà Nội,",
    "Việt Nam",
    "Điện thoại: 0706888818 Fax:",
];

$address = null;

foreach ($line as $key => $value) {
    if (strpos($value, '4. Địa chỉ trụ sở chính') !== false) {
        $address = trim($value);
        if (isset($line[$key + 1]) && strpos($line[$key + 1], ':') === false) {
            $address .= " " . trim($line[$key + 1]);
        }
        if (isset($line[$key + 2]) && strpos($line[$key + 2], ':') === false) {
            $address .= " " . trim($line[$key + 2]);
        }
        if (isset($line[$key + 3]) && strpos($line[$key + 2], ':') === false) {
          $address .= " " . trim($line[$key + 3]);
      }
        break;
    }
}

dd($address);


  // email
  $lines = [
    'Email: phattriengiaoducthehetre@gma Website:',
    'il.com',
    '5. Ngành, nghề kinh doanh:'
  ];
  $email = null;

  for ($i = 0; $i < sizeof($lines); $i++) {
    $matches = [];
    preg_match('/(?:Email:)\s*([\w\-.+]+@[\w\-.]+)/i', $lines[$i], $matches);
    if (isset($matches[1])) {
      $email = trim($matches[1]);
      if (isset($lines[$i + 1]) && strpos($lines[$i + 1], '5. Ngành, nghề kinh doanh:') !== 0) {
        $email .=  trim($lines[$i + 1]);
      }
    }
  }

  dd($email);
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

Route::get('api/process-file', [FileController::class, 'index']);
Route::post('api/process-file', [FileController::class, 'process']);
