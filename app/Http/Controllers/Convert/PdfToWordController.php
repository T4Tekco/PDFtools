<?php

namespace App\Http\Controllers\Convert;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\IOFactory;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Mpdf\Mpdf;

// pdf to word
use Dompdf\Dompdf;
use App;

use App\htmltoword\HTML_TO_DOC;

class PdfToWordController extends Controller
{
    private $logger;

    public function __construct()
    {
        $this->logger = new NullLogger();
    }
    public function index()
    {
        // return view('convertFile');
        return response()->json([
            'status' => '100',
            'message' => 'Invalid file format',
        ], 422);
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
                'status' => '100',
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
        try {
            // Validate the uploaded file
            $request->validate([
                'file' => 'required|mimes:docx|max:1000048',
            ]);

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
            // Load the HTML file
            $html = file_get_contents($tempFile . '.html');

            // Split the HTML code into smaller chunks
            $htmlChunks = str_split($html, 1000000);

            // Convert the HTML to PDF using mPDF
            $mpdf = new Mpdf(['mode' => 'utf-8', 'tempDir' => sys_get_temp_dir()]);
            $mpdf->setLogger($this->logger); // Set the logger

            foreach ($htmlChunks as $chunk) {
                $mpdf->WriteHTML($chunk);
            }

            $mpdf->Output($tempFile . '.pdf', 'F');


            // Return the PDF file as a download
            return response()->download($tempFile . '.pdf', $wordFile->getClientOriginalName() . '.pdf');
        } catch (\Exception $e) {
            // Return error message and status code in case of an error
            return response()->json([
                'status' => '100',
                'message' => 'Invalid file',
            ], 422);
        }
    }
 
    // pdf to word 

    public function convertToWord(Request $request)
    {
        try {
            // Validate the uploaded file
            $request->validate([
                'file' => 'required|mimes:pdf|max:2048',
            ]);

            // Get the uploaded PDF file
            $pdfFile = $request->file('file');
            // Convert PDF to Word
            $phpWord = IOFactory::load($pdfFile);


            // Save the Word document as HTML
            $tempFile = tempnam(sys_get_temp_dir(), 'word');
            $phpWord->save($tempFile . '.html', 'HTML');

            // Load the HTML file
            $html = file_get_contents($tempFile . '.html');

            // Convert HTML to Word using PhpWord
            $htd = new HTML_TO_DOC();
            // $htd -> createDoc($html ,  "my-document" ,  1 );
            // $phpWord = new PhpWord();
            // $section = $phpWord->addSection();
            // \PhpOffice\PhpWord\Shared\Html::addHtml($section, $html);
            // $tempFile = tempnam(sys_get_temp_dir(), 'word');
            // $phpWord->save($tempFile . '.docx', 'Word2007');

            // // Return the Word file as a download
            return response()->download($html . '.docx', $pdfFile->getClientOriginalName() . '.docx');
        } catch (\Exception $e) {
            // Return error message and status code in case of an error
            return response()->json([
                'status' => '100',
                'message' => 'Invalid file',
            ], 422);
        }
    }


    // public function txtToPdf(Request $request){
    // try {
    //     // Validate the uploaded file
    //     $request->validate([
    //         'file' => 'required|max:2048',
    //     ]);

    //     $txtFile = $request->file('file');
    //     $filename = $txtFile->getClientOriginalName(); // Get the original filename

    //     // Read the contents of the file
    //     $content = file_get_contents($txtFile);
    //     $content = iconv(mb_detect_encoding($content, mb_detect_order(), true), "UTF-8", $content);

    //     // // Create a new Dompdf instance
    //     // $dompdf = new Dompdf();

    //     // // Load the contents of the file into Dompdf
    //     // $dompdf->loadHtml($content);
    //     // // Render the PDF
    //     // $dompdf->render();

    //     // // Save the PDF to a file
    //     // $pdf = $dompdf->output();
    //     $newPdfFile = ''.$filename.'.pdf';
    //     // $dompdf->stream($newPdfFile);
    //     // file_put_contents(  $newPdfFile, $pdf);
    //     $pdf = App::make('dompdf.wrapper');
    //     $pdf->loadHTML($content);

    //     // Return the PDF as a response
    //      $pdf->stream($newPdfFile);

    //     // Return the new PDF file as a download with the original filename
    //     return response()->download($newPdfFile, $filename);
    // } catch (\Exception $e) {
    //     // Return error message and status code in case of an error
    //     return response()->json([
    //         'status' => 'error',
    //         'message' => 'Invalid file format',
    //     ], 422);
    // }
    // }


}
