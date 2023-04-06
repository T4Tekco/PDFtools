<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



class analyser extends Controller
{
    
    
    // public function analyzePdf(Request $request)
    // {
    //     $pdfFile = $request->file('pdf_file');
        
    //     // Save the PDF file to local storage
    //     $path = $pdfFile->store('pdfs');
        
    //     // Instantiate the TCPDF object
    //     $pdf = new Tfpdf();
        
    //     // Set the source file for the PDF object
    //     $pageCount = $pdf->setSourceFile(Storage::path($path));
        
    //     // Loop through each page of the PDF and extract the text
    //     $text = '';
    //     for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
    //         $pdf->AddPage();
    //         $templateId = $pdf->importPage($pageNo);
    //         $pdf->useTemplate($templateId);
    //         $text .= $pdf->getTextByPage($pageNo);
    //     }
        
    //     // Output the extracted text
    //     return response($text);
    // }
}
