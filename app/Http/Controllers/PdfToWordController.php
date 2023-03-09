<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\IOFactory;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Mpdf\Mpdf;

// pdf to word
use Spatie\PdfToText\Pdf;
use PhpOffice\PhpWord\PhpWord;

class PdfToWordController extends Controller
{
    private $logger;

    public function __construct()
    {
        $this->logger = new NullLogger();
    }
    public function index()
    {
        return view('convertFile');
    }
    public function process(Request $request)
    {
        try {
            // Validate the uploaded file
            $request->validate([
                'file' => 'required|max:2048',
            ]);

            // Get the file extension
            $extension = $request->file('file')->getClientOriginalExtension();

            // Check the file extension and validate accordingly
            if ($extension == 'pdf') {
                $request->validate([
                    'file' => 'mimes:pdf',
                ]);
                // Process the PDF file
                $this->processPdfFile($request->file('file'));
            } elseif ($extension == 'doc' || $extension == 'docx') {
                $request->validate([
                    'file' => 'mimes:doc,docx',
                ]);
                // Process the Word file
                // $this->convertToPdf($request->file('file'));
            } elseif ($extension == 'txt') {
                $request->validate([
                    'file' => 'mimes:txt',
                ]);
                // Process the TXT file
                $this->processTxtFile($request->file('file'));
            } else {
                // Invalid file type
                throw new \Exception('File type not supported');
            }

            // Return the output in JSON format
            // return response()->json([
            //     'status' => 'success',
            //     'output' => $output,
            // ]);
        } catch (\Exception $e) {
            // Return error message and status code in case of an error
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid file format',
            ], 422);
        }
    }


    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function convertToPdf(Request $request)
    {
        // Get the uploaded Word file
        $wordFile = $request->file('file');

        // Load the Word document
        $phpWord = IOFactory::load($wordFile);

        // Save the Word document as HTML
        $tempFile = tempnam(sys_get_temp_dir(), 'word');
        $phpWord->save($tempFile . '.html', 'HTML');

        // Load the HTML file
        $html = file_get_contents($tempFile . '.html');

        // Convert the HTML to PDF using mPDF
        $mpdf = new Mpdf(['mode' => 'utf-8', 'tempDir' => sys_get_temp_dir()]);
        $mpdf->setLogger($this->logger); // Set the logger
        // $mpdf->WriteHTML($html, HTMLParserMode::HTML_BODY, true, false, '', true, 'Normal,Balloon Text');
        $mpdf->WriteHTML($html);
        $mpdf->Output($tempFile . '.pdf', 'F');

        // Return the PDF file as a download
        return response()->download($tempFile . '.pdf', $wordFile->getClientOriginalName() . '.pdf');
    }

    // pdf to word 



    public function convertToWord(Request $request)
    {
        // Get the uploaded PDF file
        $pdfFile = $request->file('file');

        // Convert PDF to Word

        $text =  (new Pdf(getenv('PDFTOTEXT_PATH')))->setPdf($pdfFile)->text();
        $html = '<html><body>' . nl2br(e($text)) . '</body></html>';
        $html = preg_replace('/[\x00-\x1F\x7F]/u', '', $html);

        // Convert HTML to Word using PhpWord
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        \PhpOffice\PhpWord\Shared\Html::addHtml($section, $html);
        $tempFile = tempnam(sys_get_temp_dir(), 'word');
        $phpWord->save($tempFile . '.docx', 'Word2007');

        // Return the Word file as a download
        return response()->download($tempFile . '.docx', $pdfFile->getClientOriginalName() . '.docx');
    }
}
