<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\PdfToText\Pdf;
use Illuminate\Support\Facades\Storage;
use Smalot\PdfParser\Parser;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
// use setasign\Fpdi\Tcpdf\Fpdi;

use Illuminate\Support\Str;

class pdftxt extends Controller
{
    public function index()
    {
        
        return view('convert');
    }
    public function convertToWord(Request $request)
        {
            try {
                // Validate the uploaded file
                $request->validate([
                    'file' => 'required|mimes:pdf|max:2048',
                ]);
    
                // Get the uploaded PDF file
                $pdfFile = $request->file('file');
        $texts = (new Pdf(getenv('PDFTOTEXT_PATH')))->setPdf($pdfFile)->text();
        $file = storage_path('app/converted-text.txt');
        file_put_contents($file, $texts);
        // txt to json
        $filePath = storage_path('app/converted-text.txt');
        $text = file_get_contents($filePath);
        $encoding = mb_detect_encoding($text);

        // Convert the text to UTF-8 and then to an array
        $utf8Text = iconv($encoding, 'UTF-8', $text);

        $dataArray = explode("\n", $utf8Text);
        $dataArray =  str_replace("\r", "", $dataArray);
        // Initialize an array to store the data
        $data = [];
        // // Loop through each line and extract the data
        //1
        $group = '';
        $key = '';
        $pattern = '/\s+/'; // matches digits followed by a dot and one or more spaces
        $replacement = ''; // replace with empty string
        for ($i =  0; $i < sizeof($dataArray); $i++) {
            $line = trim($dataArray[$i]);

            // Check if the line contains a colon (':')
            if (strpos($line, ':') !== false) {
                $parts = explode(':', $line, 2);
                if (is_numeric(Str::slug(pathinfo(trim($line), PATHINFO_FILENAME), '_'))) {
                    if (strpos($line, '. ') !== false) {
                        $group =  Str::slug(pathinfo($line, PATHINFO_FILENAME), '_');
                    }
                }
                // Split the line into key and value
                $key = preg_replace($pattern, $replacement, trim($parts[0]));
                if (strpos($dataArray[$i + 1], ':') !== false) {
                    $value = trim($dataArray[$i]);
                } else    if (strpos($dataArray[$i + 2], ':') !== false) {
                    $value = trim($dataArray[$i]) . " " . trim($dataArray[$i + 1]);
                } else {
                    $value = trim($dataArray[$i]) . " " . trim($dataArray[$i + 1]) . " " . trim($dataArray[$i + 2]);;
                }
                $legal_representative = explode(':', $value);
                if (sizeof($legal_representative) >= 2) {
                    $data[$group][Str::slug(pathinfo($key, PATHINFO_FILENAME), '_')] =  trim($legal_representative[1]);
                }
            }
        }
        Storage::delete('converted-text.txt');
        $jsonData = json_encode($data, JSON_UNESCAPED_UNICODE);
        $newFilename =   $pdfFile->getClientOriginalName() . '.json'; // your new JSON file name
         Storage::put($newFilename, $jsonData);
        return response()->download(storage_path("app/{$newFilename}"))->deleteFileAfterSend();
        //end data
    }catch (\Exception $e) {
        // Return error message and status code in case of an error
        return response()->json([
            'status' => '100',
            'message' => 'Invalid file',
        ], 422);
    }
        //   Return a view with the JSON data
    }

}
