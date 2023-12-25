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


Route::get('/', [homeapge::class, 'Homepage'])->name('Homepage');

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
