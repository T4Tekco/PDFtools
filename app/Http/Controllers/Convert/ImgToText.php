<?php

namespace App\Http\Controllers\convert;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use thiagoalessio\TesseractOCR\TesseractOCR;

class ImgToText extends Controller
{
    public function convertImgToTextBase64_(Request $request)
    {
        $imageBase64  = $request->imageBase64;
        try {

            $command = 'where tesseract';
            $process = Process::fromShellCommandline($command);
            $process->run();
            $path = trim($process->getOutput());
            // dd($path);
            // $imageData = str_replace('data:image/png;base64,', '', $imageBase64);
            // Decode the base64 string to binary image data
            $binaryImageData = base64_decode($imageBase64);

            // Generate a temporary file to save the image data.
            $tempImageFile = tempnam(sys_get_temp_dir(), 'ocr_');
            file_put_contents($tempImageFile, $binaryImageData);

            // Set the path to the Tesseract executable
            $tesseractPath = 'tesseract';

            // Set the path to the "tessdata" directory
            $tessdataDir = 'C:\Program Files\Tesseract-OCR\tessdata';

            // Perform OCR on the image.
            $ocr = new TesseractOCR($path);
            $ocr->lang('eng'); // Specify the language (optional, if needed)
            $ocr->image($tempImageFile); // Set the path to the temporary image file
            $ocr->tessdataDir($tessdataDir); // Set the "tessdata" directory
            $result = $ocr->run(); // Run OCR to extract text from the image

            // Remove the temporary image file
            unlink($tempImageFile);
            // echo '<img src="data:image=png;base64,'.$imageBase64.'">';
            // // Display or process the extracted text
            // dd($result,$imageBase64);

            return $result;
        } catch (\Throwable $th) {
            //throw $th;

            return 100;
        }
    }

    public function convertImgToText_(Request $request)
    {
        // For Windows
        $command = 'where tesseract';
        $path = exec($command);
    
        $imageFile = $request->file('images');
    
        // Make sure the uploaded file is valid and move it to a temporary location
        if ($imageFile && $imageFile->isValid()) {
            $tempImageFile = tempnam(sys_get_temp_dir(), 'ocr_');
            $imageFile->move(sys_get_temp_dir(), $tempImageFile);
        } else {
            // Handle the case when the uploaded file is not valid
            return response()->json(['error' => 'Invalid uploaded image.'], 400);
        }
    
        
        $ocr = new TesseractOCR($path);
        $command = $ocr->buildCommand();

        $ocr->lang('eng'); // Specify the language (optional, if needed)
        $ocr->image($tempImageFile); // Set the path to the temporary image file
        $result = $ocr->run(); // Run OCR to extract text from the image
            // Remove the temporary image file
            unlink($tempImageFile);
        
    
        return response()->json([
            'text' => $result
        ]);
    }
    
}
