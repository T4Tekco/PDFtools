<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\PdfToText\Pdf;

class ConversionController extends Controller
{
    public function index(){
        return view('pdf-to-txt');
    }
    public function pdfToTxt(Request $request)
    {
        $pdfPath = $request->file('pdf_file')->getPathname();
        $txt = Pdf::getText($pdfPath);
        return response()->view('txt', compact('txt'));
    }

    public function txtToJson(Request $request)
    {
        $txt = $request->input('txt');
        $json = json_encode(['text' => $txt]);
        return response()->json($json);
    }
}
