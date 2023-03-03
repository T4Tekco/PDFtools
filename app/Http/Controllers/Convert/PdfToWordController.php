<?php

namespace App\Http\Controllers\Convert;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use Smalot\PdfParser\PdfParser;

class PdfToWordController extends Controller
{
    public function index()
    {
        return view('convertFile');
    }

    public function convertFileToWord(Request $request)
    {
        // Get the PDF file from the request
        $pdfFile = $request->file('pdf_file');

        // Extract text from the PDF file using setasign/fpdi
        $pdfParser = new PdfParser();
        $pdfParser->setSourceFile($pdfFile->path());
        $pdfContent = $pdfParser->getAllPages()[1]['Text'];

        
        // Create a new PHPWord object and add the PDF content to it
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        $section->addText($pdfContent);
        // Save the Word file
        $wordFilePath = storage_path('app/public/converted_word.docx');
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($wordFilePath);

        // Return a response with the path to the converted Word file
        return response()->download($wordFilePath)->deleteFileAfterSend();
    }
}
