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

  $lines = [
    'tên doanh nghiệp viết bằng tiếng việt: công cty abc -',
    'lang sonw',
  ];
  

$data['company_name'] = [];

$currentType = '';
$currentName = '';

for ($i=0; $i <sizeof($lines) ; $i++) { 

    $pattern = '/^tên (công ty|doanh nghiệp) viết (bằng tiếng Việt|bằng tiếng nước ngoài|viết tắt):\s*(.*)/iu';
    if (preg_match($pattern,  $lines[$i], $matches)) {
        $type = strtolower($matches[2]);
        $name = trim($matches[3]);
        $currentName =   $name;
        // If previous type is 'bằng tiếng việt', concatenate the name with current line
        if (preg_match('/^tên (công ty|doanh nghiệp) viết bằng tiếng Việt:\s*(.*)/iu', $lines[$i + 1], $matches) == 0) {
          $currentName .= ' ' .  $lines[$i + 1];
  
        } 
        switch ($type) {
            case 'bằng tiếng việt':
                $data['company_name']['vietnamese'] = $currentName;
                break;
            case 'bằng tiếng nước ngoài':
                $data['company_name']['foreign'] = $name;
                break;
            case 'viết tắt':
                $data['company_name']['abbreviation'] = $name;
                break;
        }
    }
}

// Remove trailing hyphen and extra spaces from the Vietnamese company name
if (isset($data['company_name']['vietnamese'])) {
    $data['company_name']['vietnamese'] = rtrim($data['company_name']['vietnamese'], '- ');
}

// Output the result
dd($data['company_name']);

  // $text1 = 'Số 86 Nguyễn Tri Phương, Khu Phố Tân Long, Phường Tân Hiệp, Thành phố Tân Uyên, Tỉnh Bình Dương, Việt Nam';
  // $text2 = 'Số 34 Ngõ 2/114 phố Tân Phong, Phường Thụy Phương, Quận Bắc Từ Liêm, Thành phố Hà, Việt Nam';

  // $address_parts = explode(',', $text1);
  // $data = [
  //   'headquarters_address' => [
  //     'street' => '',
  //     'district' => '',
  //     'city' => ''
  //   ]
  // ];
  // for ($i = 0; $i < sizeof($address_parts); $i++) {
  //   if (strpos($address_parts[$i], 'Thành phố') !== false) {
  //     $data['headquarters_address']['city'] = trim($address_parts[$i]);
  //   } elseif (strpos($address_parts[$i], 'Quận') !== false || strpos($address_parts[$i], 'Tỉnh') !== false) {
  //     $data['headquarters_address']['district'] = trim($address_parts[$i]);
  //   } elseif (strpos($address_parts[$i], 'Quận') !== false || strpos($address_parts[$i], 'Tỉnh') !== false) {
  //     $data['headquarters_address']['district'] = trim($address_parts[$i]);
  //   } else {
  //     $data['headquarters_address']['street'] .= trim($address_parts[$i]);
  //   }
  //   # code...
  // }

  // // Output the results
  // dd($data);
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
