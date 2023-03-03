<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use setasign\Fpdi\Tcpdf\Fpdi;

class PdfToexcelController extends Controller
{
    public function index()
    {
        return view('pdf-to-excel');
    }

    public function convert(Request $request)
    {
        $pdfFile = $request->file('pdf');
        $pdfFilePath = $pdfFile->getPathName();
        $excelFilePath = storage_path('app/public') . '/' . $pdfFile->getClientOriginalName() . '.xlsx';

        $pdf = new Fpdi();
        $pageCount = $pdf->setSourceFile($pdfFilePath);
        $text = '';
        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            $template = $pdf->importPage($pageNo);
            $text .= $pdf->getTemplateContent($template);
        }

        // Convert text to Excel
        $spreadsheet = new Spreadsheet();
        $worksheet = $spreadsheet->getActiveSheet();
        $lines = explode("\n", $text);
        $row = 1;
        foreach ($lines as $line) {
            $values = explode("\t", $line);
            $col = 1;
            foreach ($values as $value) {
                $worksheet->setCellValueByColumnAndRow($col, $row, $value);
                $col++;
            }
            $row++;
        }

        // Save Excel file
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($excelFilePath);

        return response()->download($excelFilePath);
    }
}
