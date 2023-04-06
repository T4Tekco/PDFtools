<?php

namespace App\Http\Controllers;
// require_once '/vendor/pdfbox-app-3.0.0-alpha3.jar';
use Exception;
use Illuminate\Http\Request;
use SGH\PdfBox\PdfBox;
use Spatie\PdfToText\Pdf;
use Illuminate\Support\Facades\Storage;

use org\apache\pdfbox\pdfparser\PDFParser;
use org\apache\pdfbox\pdmodel\PDDocument;
use org\apache\pdfbox\text\PDFTextStripper;

use Illuminate\Support\Str;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class pdftxt extends Controller
{
    public function index()
    {

        return response()->json([
            'status' => '422',
            'message' => 'Invalid file',
        ]);
    }
    public function convertToTxt(Request $request)
    {
        try {
            // Validate the uploaded file
            $validatedData = $request->validate([
                'file' => 'required|mimes:pdf|max:2048',
            ]);

            // Get the uploaded PDF file
            $pdfFile = $request->file('file');

            // Convert PDF to text using pdftotext utility with WinAnsi encoding
            $pdfToText = (new Pdf(getenv('PDFTOTEXT_PATH')))
                ->setPdf($pdfFile)
                // ->setOptions(['enc' => 'WinAnsiEncoding'])
                ->text();

            // Save text data to a file
            $fileName = $pdfFile->getClientOriginalName() . '.txt';
            Storage::put($fileName, $pdfToText);

            // Download the text file
            return response()->download(storage_path('app/' . $fileName))->deleteFileAfterSend(true);
        } catch (Exception $e) {
            // Return error message and status code in case of an error
            return response()->json([
                'status' => '422',
                'message' => 'Invalid file',
            ], 422);
        }
    }



    public function convertToJson(Request $request)
    {
        try {
            // Validate the uploaded file
            $request->validate([
                'file' => 'required|mimes:txt|max:2048',
            ]);

            // Get the uploaded PDF file
            $file = $request->file('file');
            $text = file_get_contents($file);
            $encoding = mb_detect_encoding($text);

            // Convert the text to UTF-8 and then to an array
            $utf8Text = iconv($encoding, 'UTF-8', $text);

            $dataArray = explode("\n", $utf8Text);
            $dataArray =  str_replace("\r", "", $dataArray);
            // Initialize an array to store the data
            $data = [];
            // // Loop through each line and extract the data
            //1
            $group = 'group';
            $key = 'key';
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
            $jsonData = json_encode($data, JSON_UNESCAPED_UNICODE);
            $newFilename =   $file->getClientOriginalName() . '.json'; // your new JSON file name
            Storage::put($newFilename, $jsonData);
            return response()->download(storage_path("app/{$newFilename}"))->deleteFileAfterSend();
            //end data
        } catch (Exception $e) {
            // Return error message and status code in case of an error
            return response()->json([
                'status' => '100',
                'message' => 'Invalid file',
            ], 422);
        }
        //   Return a view with the JSON data
    }


    public function convertToJsontest(Request $request)
    {

        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:txt|max:2048',
        ]);

        // Get the uploaded PDF file
        $file = $request->file('file');
        $text = file_get_contents($file);
        $encoding = mb_detect_encoding($text);

        // Convert the text to UTF-8 and then to an array
        $utf8Text = iconv($encoding, 'UTF-8', $text);

        $dataArray = explode("\n", $utf8Text);
        $dataArray =  str_replace("\r", "", $dataArray);
        // Initialize an array to store the data
        $data = [];
        // // Loop through each line and extract the data
        //1
        $group = 'group';
        $key = 'key';
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
                if (isset($dataArray[$i + 1]) && strpos($dataArray[$i + 1], ':') !== false) {
                    $value = trim($dataArray[$i]) . " " . trim($dataArray[$i + 1]);
                } else  if (isset($dataArray[$i + 2]) && strpos($dataArray[$i + 2], ':') !== false) {
                    $value = trim($dataArray[$i]) . " " . trim($dataArray[$i + 1]) . " " . trim($dataArray[$i + 2]);;
                } else {
                    $value = trim($dataArray[$i]);
                }
                $legal_representative = explode(':', $value);
                if (sizeof($legal_representative) >= 2) {
                    $data[$group][Str::slug(pathinfo($key, PATHINFO_FILENAME), '_')] =  trim($legal_representative[1]);
                }
            }
        }
        $jsonData = json_encode($data, JSON_UNESCAPED_UNICODE);
        $newFilename =   $file->getClientOriginalName() . '.json'; // your new JSON file name
        Storage::put($newFilename, $jsonData);
        return response()->download(storage_path("app/{$newFilename}"))->deleteFileAfterSend();
        //end data

        //   Return a view with the JSON data
    }
    // public function convertPdfToTextda(Request $request)
    // {
    //     $pdfFile = $request->file('file');
    //     // create PDF parser object
    //     $parser = new PDFParser(new \SplFileObject($pdfFile));

    //     // parse PDF file
    //     $parser->parse();

    //     // get the document object
    //     $document = $parser->getPDDocument();

    //     // create PDF text stripper object
    //     $textStripper = new PDFTextStripper();

    //     // extract text from PDF
    //     $text = $textStripper->getText($document);

    //     // close the document
    //     $document->close();

    //     // return the extracted text
    //     return $text;
    // }
    public function convertfilepdfencode(Request $request)
    {
        // Validate the uploaded file
        $validatedData = $request->validate([
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        // Get the uploaded PDF file
        $pdfFile = $request->file('file');

        // Convert PDF to text using pdftotext utility with WinAnsi encoding
        // $pdfToText = (new Pdf(getenv('PDFTOTEXT_PATH')))
        //     ->setOptions(['-enc', 'ISO-8859-1', '-raw', '-q'])
        //     ->setPdf($pdfFile)
        //     ->text();
        $pdfToText = (new Pdf(getenv('PDFTOTEXT_PATH')))
            ->setOptions(['-enc' => 'MacRoman'])
            ->setPdf($pdfFile)

            ->text();


        // Save text data to a file
        $fileName = $pdfFile->getClientOriginalName() . '.txt';
        Storage::put($fileName, $pdfToText);

        // Download the text file
        return response()->download(storage_path('app/' . $fileName))->deleteFileAfterSend(true);
    }
    public function convertPdfToText(Request $request)
    {
        $pdfFile = $request->file('file');
        $pdfFileName = pathinfo($pdfFile->getClientOriginalName(), PATHINFO_FILENAME);
        $textFile = $pdfFileName . ".txt";
        // create file
        // Storage::put($textFile, '  not found');
        $txtPath = storage_path('app/' . $textFile . '');
        $javaPath = 'C:\Program Files\Java\jre1.8.0_361\bin\java.exe';
        $pdftotextPath = base_path() . '/vendor/pdfbox-app-3.0.0-alpha3.jar';
        // Set the command to convert the PDF to text using pdfboxXXX
        // $command = $javaPath . ' -jar ' . base_path() . '/vendor/pdfbox-app-3.0.0-alpha3.jar export:text -sort -i ' . $pdfFile->getRealPath() . ' -o ' . storage_path('app/' . $textFile);
        $process = new Process([$javaPath, '-jar', $pdftotextPath, 'export:text', '-sort', '-i', $pdfFile, '-o', $txtPath]);
        // Run the command using the Symfony Process component
        $process->run();
        // Check if the command was successful, and handle any errors
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        // Return the converted text as a downloadable file
        return response()->download(storage_path('app/' . $textFile))->deleteFileAfterSend(true);
    }

    public function test(Request $request)
    {
        // Store the file in the storage folder
        // $path = $file->store('public');
        $file = $request->file('file');
        // // Get the original file name
        $fileName = $file->getClientOriginalName();

        // Process the file using any third-party libraries or tools
        $pdftotextPath = getenv('PDFTOTEXT_PATH');
        $fileName = $file->getClientOriginalName();
        // Get the path to the temporary file created by Laravel
        $filePath = $file->getRealPath();
        // Remove any special characters from the file name
        $cleanName = Str::slug(pathinfo($fileName, PATHINFO_FILENAME), '-');

        // Get the file extension
        $extension = $file->getClientOriginalExtension();

        // Create the new file name
        $newName = $cleanName . '.' . $extension;

        $process = new Process([$pdftotextPath, $filePath]);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        $texts = (new Pdf(getenv('PDFTOTEXT_PATH')))->setPdf($filePath)->text();

        // end xu ly file

        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $mydate = getdate(date("U"));
        $today = "$mydate[year]$mydate[mon]$mydate[mday]$mydate[hours]$mydate[minutes]$mydate[seconds]";

        //   echo Pdf::getText($pdfPath, $pdftotextPath);
        $files = storage_path('app/' .  $newName  . $today . '.txt');
        file_put_contents($files, $texts);
        // txt to json
        $filePath = storage_path('app/' . $newName  . $today . '.txt');
        $text = file_get_contents($file);
        // $encoding = mb_detect_encoding($text);
        // // set utf 8
        // $utf8Text = iconv(   $encoding, 'UTF-8', $text);
        $dataArray = explode("\n", $text);
        $dataArray =  str_replace("\r", "", $dataArray);
        // create data 
        $data = [
            "company_name" => [
                "vietnamese" => "",
                "foreign" => "",
                "abbreviation" => ""
            ],
            "tax_code" => "",
            "establishment_date" => "",
            "headquarters_address" => [
                "street" => "",
                "ward" => "",
                "district" => "",
                "city" => "",
                "country" => "",
                "phone" => "",
                "fax" => "",
                "Email" => "",
                "website" => ""
            ],
            "business_lines" => [
                'main_industry_code' => ''

            ],
            "charter_capital" => "",
            "owner_info" => [
                "full_name" => "",
                "sex" => "",
                "dayofbirthday" => "",
                "ethnicity" => "",
                "nationality" => "",
                "legal_document_type" => "",
                "legal_document_number" => "",
                "legal_document_date" => "",
                "legal_document_place" => "",
                "permanent_address" => "",
                "contact_address" => ""
            ],
            "legal_representative" => [
                "full_name" =>  "",
                "sex" => "",
                "position" =>  "",
                "birthday" =>  "",
                "ethnicity" =>  "",
                "nationality" =>  "",
                "legal_document_type" =>  "",
                "legal_document_number" =>  "",
                "legal_document_date" =>  "",
                "legal_document_place" =>  "",
                "permanent_address" =>  "",
                "contact_address" =>  ""
            ],
            "registration_office" =>  ""
        ];
        // xu ly mục 1 -4 and 6 
        for ($i = 0; $i < sizeof($dataArray); $i++) {
            $line = trim($dataArray[$i]);
            if (!empty($line)) {
                // Split the line by the colon
                $parts = explode(':', $line, 2);
                if (strpos($line, 'CÔNG BỐ NỘI DUNG ĐĂNG KÝ THÀNH LẬP MỚI') !== false) {
                    continue;
                }
                if (strpos($line, 'Mã số doanh nghiệp') !== false) {

                    $data['tax_code'] = trim($dataArray[$i - 1]);
                    //    trim(str_replace('Mã số doanh nghiệp:', '', $line));
                } elseif (strpos($line, 'Tên công ty viết bằng tiếng Việt') !== false) {
                    $data['company_name']['vietnamese'] = trim(str_replace('Tên công ty viết bằng tiếng Việt:', '', $line));
                } elseif (strpos($line, 'Tên công ty viết bằng tiếng nước ngoài') !== false) {
                    $data['company_name']['foreign'] = trim(str_replace('Tên công ty viết bằng tiếng nước ngoài:', '', $line));
                } elseif (strpos($line, 'Tên công ty viết tắt') !== false) {
                    $data['company_name']['abbreviation'] = trim(str_replace('Tên công ty viết tắt:', '', $line));
                } elseif (strpos($line, 'Địa chỉ trụ sở chính') !== false) {
                    $address = trim($dataArray[$i + 1]) . " " . trim($dataArray[$i + 2]);
                    $address_parts = explode(',', $address);
                    if (sizeof($address_parts) >= 5) {
                        $data['headquarters_address']['street'] = trim($address_parts[0]);
                        $data['headquarters_address']['ward'] = trim($address_parts[1]);
                        $data['headquarters_address']['district'] = trim($address_parts[2]);
                        $data['headquarters_address']['city'] = " " . trim($address_parts[3]);
                        $data['headquarters_address']['country'] = trim($address_parts[4]);
                    }
                } elseif (strpos($line, 'Điện thoại') !== false) {
                    $data['headquarters_address']['phone'] = trim(str_replace('Điện thoại:', '', $line));
                } elseif (strpos($line, 'Fax') !== false) {
                    $data['headquarters_address']['fax'] = trim(str_replace('Fax:', '', $line));
                } elseif (strpos($line, 'Email') !== false) {
                    $data['headquarters_address']['Email'] = trim(str_replace('Email:', '', $line));
                } elseif (strpos($line, 'Điện thoại') !== false) {
                    $data['headquarters_address']['website'] = trim(str_replace('Website:', '', $line));
                } elseif (strpos($line, 'Ngày thành lập') !== false) {
                    $data['establishment_date'] = trim($dataArray[$i - 1]);

                    //trim(str_replace('Ngày; thành lập:', '', $line));
                } elseif (strpos($line, 'Ngành, nghề kinh doanh') !== false) {
                    continue;
                } elseif (strpos($line, ' VNĐ') !== false) {
                    $charter_capital = explode(':', $line);
                    if (sizeof($charter_capital) >= 2) {
                        $data['charter_capital'] = trim($charter_capital[1]);
                    }
                }
            }
        }
        // table
        for ($i =  0; $i < sizeof($dataArray); $i++) {
            $line = trim($dataArray[$i]);
            if (strpos($line, 'STT Tên ngành Mã ngành') !== false) {
                $position = $i;
                for ($i =  $position; $i < sizeof($dataArray); $i++) {
                    $arr = trim($dataArray[$i]);
                    if (is_numeric($dataArray[$i])) {
                        if (strpos($arr, '.') === false) {
                            $data['business_lines'][] = [
                                'industry_code' => $dataArray[$i]
                            ];
                        }
                    }
                    if (strpos($arr, '(Chính)') !== false) {
                        $data['business_lines']['main_industry_code'] = trim(str_replace('(Chính)', '', $arr));
                    }
                    if (strpos($arr, 'Thông tin về chủ sở hữu') !== false) {
                        break;
                    }
                }
            }
        }
        // end table

        // owner info
        for ($i =  0; $i < sizeof($dataArray); $i++) {
            $line = trim($dataArray[$i]);
            if (strpos($line, 'Thông tin về chủ sở hữu') !== false) {
                $position = $i;
                for ($i =  $position; $i < sizeof($dataArray); $i++) {
                    $line = trim($dataArray[$i]);
                    if (strpos($line, 'Họ và tên') !== false && strpos($line, '* Họ và tên') == false) {
                        $parts = explode(':', $line);
                        if (sizeof($parts) >= 2) {
                            $data['owner_info']['full_name'] = $parts[1];
                        }
                        // $data['owner_info']['full_name'] = trim(str_replace('Họ và tên:', '', $line));
                    } elseif (strpos($line, 'Giới tính') !== false) {
                        $data['owner_info']['sex'] = trim(str_replace('Giới tính:', '', $line));
                    } elseif (strpos($line, 'Sinh ngày') !== false) {
                        $data['owner_info']['dayofbirthday'] = trim(str_replace('Sinh ngày:', '', $line));
                    } elseif (strpos($line, 'Dân tộc') !== false) {
                        $data['owner_info']['ethnicity'] = trim(str_replace('Dân tộc:', '', $line));
                    } elseif (strpos($line, 'Quốc tịch') !== false) {
                        $data['owner_info']['nationality'] = trim(str_replace('Quốc tịch:', '', $line));
                    } elseif (strpos($line, 'Loại giấy tờ pháp lý của cá nhân') !== false) {
                        $parts = explode(':', $line);
                        if (sizeof($parts) >= 2) {
                            $data['owner_info']['legal_document_type'] = $parts[1];
                        }
                    } elseif (strpos($line, 'Số giấy tờ pháp lý của cá nhân') !== false) {
                        $parts = explode(':', $line);
                        if (sizeof($parts) >= 2) {
                            $data['owner_info']['legal_document_number'] = $parts[1];
                        }
                        $data['owner_info']['legal_document_number'] = trim(str_replace('Số giấy tờ pháp lý của cá nhân: ', ' ', $line));
                    } elseif (strpos($line, 'Ngày cấp') !== false) {
                        $data['owner_info']['legal_document_date'] = trim(str_replace('Ngày cấp: ', '', $line));
                    } elseif (strpos($line, 'Nơi cấp') !== false) {
                        if (strpos($dataArray[$i + 1], ':') !== false) {
                            $legal = trim($dataArray[$i]);
                        } else {
                            $legal = trim($dataArray[$i]) . " " . trim($dataArray[$i + 1]);
                        }
                        $legal_representative = explode(':', $legal);
                        if (sizeof($legal_representative) >= 2) {
                            $data['owner_info']['legal_document_place'] = trim($legal_representative[1]);
                        }
                    } elseif (strpos($line, 'Địa chỉ thường trú') !== false) {
                        if (strpos($dataArray[$i + 1], ':') !== false) {
                            $legal = trim($dataArray[$i]);
                        } else {
                            $legal = trim($dataArray[$i]) . "  " . trim($dataArray[$i + 1]);
                        }
                        $legal_representative = explode(':', $legal);
                        if (sizeof($legal_representative) >= 2) {
                            $data['owner_info']['permanent_address'] = $legal_representative[1];
                        }
                    } elseif (strpos($line, 'Địa chỉ liên lạc') !== false) {
                        if (strpos($dataArray[$i + 1], ':') !== false) {
                            $legal = trim($dataArray[$i]);
                        } else {
                            $legal = trim($dataArray[$i]) . " " . trim($dataArray[$i + 1]);
                        }
                        $legal_representative = explode(':', $legal);
                        if (sizeof($legal_representative) >= 2) {
                            $data['owner_info']['contact_address'] = trim($legal_representative[1]);
                        }
                    }
                    // echo '<pre>';
                    // print_r($dataArray[$i]);
                    if (strpos($line, 'Người đại diện theo pháp luật') !== false) {
                        break;
                    }
                }
            }
        }
        //end owner info
        // legal representative 
        for ($i =  0; $i < sizeof($dataArray); $i++) {
            $line = trim($dataArray[$i]);
            if (strpos($line, '* Họ và tên') !== false) {
                $parts = explode(':', $line);
                if (sizeof($parts) >= 2) {
                    $data['legal_representative']['full_name'] = $parts[1];
                }
                // $data['legal_representative']['full_name'] = trim(str_replace('* Họ và tên:', '', $line));
            } elseif (strpos($line, 'Chức danh') !== false) {
                $data['legal_representative']['position'] = trim(str_replace('Chức danh:', '', $line));
            } elseif (strpos($line, 'Giới tính') !== false) {
                $data['legal_representative']['sex'] = trim(str_replace('Giới tính:', '', $line));
            } elseif (strpos($line, 'Sinh ngày') !== false) {
                $parts = explode(':', $line);
                if (sizeof($parts) >= 2) {

                    $data['legal_representative']['birthday'] = $parts[1];
                }
                //    $data['legal_representative']['birthday'] = trim(str_replace('Sinh ngày:', '', $line));
            } elseif (strpos($line, 'Dân tộc') !== false) {
                $data['legal_representative']['ethnicity'] = trim(str_replace('Dân tộc:', '', $line));
            } elseif (strpos($line, 'Quốc tịch') !== false) {
                $data['legal_representative']['nationality'] = trim(str_replace('Quốc tịch:', '', $line));
            } elseif (strpos($line, 'Loại giấy tờ pháp lý của cá nhân') !== false) {
                $data['legal_representative']['legal_document_type'] = trim(str_replace('Loại giấy tờ pháp lý của cá nhân: ', '', $line));
            } elseif (strpos($line, 'Số giấy tờ pháp lý của cá nhân') !== false) {
                if ($dataArray[$i + 1] != "") {
                    $data['legal_representative']['legal_document_number'] = trim($dataArray[$i + 1]);
                } else   if ($dataArray[$i + 2] != "") {
                    $data['legal_representative']['legal_document_number'] = trim($dataArray[$i + 2]);
                } else {
                    $data['legal_representative']['legal_document_number'] = trim(str_replace('Số giấy tờ pháp lý của cá nhân: ', '', $line));
                }
            } elseif (strpos($line, 'Ngày cấp') !== false) {
                if ($dataArray[$i + 1] != "") {
                    $data['legal_representative']['legal_document_date'] = trim($dataArray[$i + 1]);
                } else   if ($dataArray[$i + 2] != "") {
                    $data['legal_representative']['legal_document_date'] = trim($dataArray[$i + 2]);
                } else {
                    $data['legal_representative']['legal_document_date'] = trim(str_replace('Ngày cấp: ', '', $line));
                }
            } elseif (strpos($line, 'Nơi cấp') !== false) {
                if (strpos($dataArray[$i + 1], ':') !== false) {
                    $legal = trim($dataArray[$i]);
                } else {
                    $legal = trim($dataArray[$i]) . " " . trim($dataArray[$i + 1]);
                }
                $legal_representative = explode(':', $legal);
                if (sizeof($legal_representative) >= 2) {
                    $data['legal_representative']['legal_document_place'] = trim($legal_representative[1]);
                }
            } elseif (strpos($line, 'Địa chỉ thường trú') !== false) {
                if (strpos($dataArray[$i + 1], ':') !== false) {
                    $legal = trim($dataArray[$i]);
                } else {
                    $legal = trim($dataArray[$i]) . "  " . trim($dataArray[$i + 1]);
                }
                $legal_representative = explode(':', $legal);
                if (sizeof($legal_representative) >= 2) {
                    $data['legal_representative']['permanent_address'] = $legal_representative[1];
                }
            } elseif (strpos($line, 'Địa chỉ liên lạc') !== false) {
                if (strpos($dataArray[$i + 1], ':') !== false) {
                    $legal = trim($dataArray[$i]);
                } else {
                    $legal = trim($dataArray[$i]) . " " . trim($dataArray[$i + 1]);
                }
                $legal_representative = explode(':', $legal);
                if (sizeof($legal_representative) >= 2) {
                    $data['legal_representative']['contact_address'] = trim($legal_representative[1]);
                }
            }
            if (strpos($dataArray[$i], 'Người đại diện theo pháp luật') !== false) {
                break;
            }
        }

        //end owner info legal representative
        for ($i =  0; $i < sizeof($dataArray); $i++) {
            $line = trim($dataArray[$i]);
            if (strpos($line, 'Nơi đăng ký') !== false) {
                if ($dataArray[$i + 1] != "") {
                    $data['registration_office'] = trim($dataArray[$i + 1]);
                } else   if ($dataArray[$i + 2] != "") {
                    $data['registration_office'] = trim($dataArray[$i + 2]);
                }
            }
        }
        $jsonData = json_encode($data, JSON_UNESCAPED_UNICODE || JSON_PRETTY_PRINT);
        // echo '<pre>';
        // print_r($data);
        // print_r($dataArray);
        // $newFilename =   $newName  . $today . '.json'; // your new JSON file name
        // // Storage::put($newFilename, $jsonData);
        // Storage::delete($newName  . $today . '.txt');

        // // Return the processed data along with the file name
        // return [
        //     'data' => $data,
        // ];
    }

    //     public function pro(Request $request)
    //     {
    //         $file = $request->file('file');
    //         $fileName = $file->getClientOriginalName();
    //         $cleanName = Str::slug(pathinfo($fileName, PATHINFO_FILENAME), '-');
    //         $extension = $file->getClientOriginalExtension();
    //         $newName = $cleanName . '.' . $extension;

    //         // Extract text from PDF
    //         $pdfPath = $file->getRealPath();
    //         $txtPath = storage_path('app/' . $newName . '.txt');
    //         // $pdftotextPath = base_path() . '/vendor/pdfbox-app-3.0.0-alpha3.jar';
    //         // $process = new Process(['java', '-jar', $pdftotextPath, 'export:text', '-sort', '-i', $pdfPath, '-o', $txtPath]);
    //         $javaPath = 'C:\Program Files\Java\jre1.8.0_361\bin\java.exe';
    // $pdftotextPath = base_path() . '/vendor/pdfbox-app-3.0.0-alpha3.jar';
    // $process = new Process([$javaPath, '-jar', $pdftotextPath, 'export:text', '-sort', '-i', $pdfPath, '-o', $txtPath]);
    //         $process->run();

    //         // Check if text extraction was successful
    //         if (!$process->isSuccessful()) {
    //             throw new ProcessFailedException($process);
    //         }

    //         // Save text to file
    //         $text = file_get_contents($txtPath);

    //         // Convert to UTF-8 encoding
    //         $encoding = mb_detect_encoding($text);
    //         $utf8Text = iconv($encoding, 'UTF-8', $text);

    //         // Return JSON response
    //         return response()->json(['text' => $utf8Text]);
    //     }

    public function processFile1(Request $request)
    {
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $filePath = "'" . $file->getRealPath() . "'";
        $cleanName = Str::slug(pathinfo($fileName, PATHINFO_FILENAME), '-');
        $extension = $file->getClientOriginalExtension();
        $newName = $cleanName . '.' . $extension;

        // Extract text from PDF
        $txtPath = storage_path('app/' . $newName . '.txt');
        // $pdftotextPath = base_path() . '/vendor/pdfbox-app-3.0.0-alpha3.jar';
        // $process = new Process(['java', '-jar', $pdftotextPath, 'export:text', '-sort', '-i', $filePath, '-o', $txtPath]);
        $javaPath = 'C:\Program Files\Java\jre1.8.0_361\bin\java.exe';
        $pdftotextPath = base_path() . '/vendor/pdfbox-app-3.0.0-alpha3.jar';
        $process = new Process([$javaPath, '-jar', $pdftotextPath, 'export:text', '-sort', '-i', $filePath, '-o', $txtPath]);
        $process->run();
        // $command = "java -jar $pdftotextPath export:text -sort -i $filePath -o $txtPath";
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        // Save text to file
        // $text = $process->getOutput();

        // end xu ly file

        // txt to json

        $text = file_get_contents($txtPath);
        $encoding = mb_detect_encoding($text);
        // set utf 8
        $utf8Text = iconv($encoding, 'UTF-8', $text);
        $dataArray = explode("\n", $utf8Text);
        $dataArray =  str_replace("\r", "", $dataArray);
        // create data 
        $data = [
            "company_name" => [
                "vietnamese" => "",
                "foreign" => "",
                "abbreviation" => ""
            ],
            "tax_code" => "",
            "establishment_date" => "",
            "headquarters_address" => [
                "street" => "",
                "ward" => "",
                "district" => "",
                "city" => "",
                "country" => "",
                "phone" => "",
                "fax" => "",
                "Email" => "",
                "website" => ""
            ],
            "business_lines" => [
                'main_industry_code' => ''

            ],
            "charter_capital" => "",
            "owner_info" => [
                "full_name" => "",
                "sex" => "",
                "dayofbirthday" => "",
                "ethnicity" => "",
                "nationality" => "",
                "legal_document_type" => "",
                "legal_document_number" => "",
                "legal_document_date" => "",
                "legal_document_place" => "",
                "permanent_address" => "",
                "contact_address" => ""
            ],
            "legal_representative" => [
                "full_name" =>  "",
                "sex" => "",
                "position" =>  "",
                "dayofbirthday" =>  "",
                "ethnicity" =>  "",
                "nationality" =>  "",
                "legal_document_type" =>  "",
                "legal_document_number" =>  "",
                "legal_document_date" =>  "",
                "legal_document_place" =>  "",
                "permanent_address" =>  "",
                "contact_address" =>  ""
            ],
            "registration_office" =>  ""
        ];
        // xu ly mục 1 -4 and 6 
        for ($i = 0; $i < sizeof($dataArray); $i++) {
            $line = $dataArray[$i];
            if (!empty($line)) {
                // Split the line by the colon
                $parts = explode(':', $line, 2);
                if (strpos($line, 'CÔNG BỐ NỘI DUNG ĐĂNG KÝ THÀNH LẬP MỚI') !== false) {
                    continue;
                }
                if (strpos($line, 'Mã số doanh nghiệp') !== false) {
                    if (isset($dataArray[$i + 1]) && strpos($dataArray[$i + 1], ':') !== false) {
                        $value = trim($dataArray[$i]) . " " . trim($dataArray[$i + 1]);
                    } else  if (isset($dataArray[$i + 2]) && strpos($dataArray[$i + 2], ':') !== false) {
                        $value = trim($dataArray[$i]) . " " . trim($dataArray[$i + 1]) . " " . trim($dataArray[$i + 2]);;
                    } else {
                        $value = trim($dataArray[$i]);
                    }
                    $legal_representative = explode(':', $value);
                    if (sizeof($legal_representative) >= 2) {
                        $data['tax_code'] =  trim(str_replace('3. Ngày thành lập', '', $legal_representative[1]));
                    }
                    // $data['tax_code'] = trim($dataArray[$i]);
                    //    trim(str_replace('Mã số doanh nghiệp:', '', $line));
                } elseif (strpos($line, 'Tên công ty viết bằng tiếng Việt') !== false) {
                    $data['company_name']['vietnamese'] = trim(str_replace('Tên công ty viết bằng tiếng Việt:', '', $line));
                } elseif (strpos($line, 'Tên công ty viết bằng tiếng nước ngoài') !== false) {
                    $data['company_name']['foreign'] = trim(str_replace('Tên công ty viết bằng tiếng nước ngoài:', '', $line));
                } elseif (strpos($line, 'Tên công ty viết tắt') !== false) {
                    $data['company_name']['abbreviation'] = trim(str_replace('Tên công ty viết tắt:', '', $line));
                } elseif (strpos($line, 'Địa chỉ trụ sở chính') !== false) {
                    $address = trim($dataArray[$i + 1]) . " " . trim($dataArray[$i + 2]);
                    $address_parts = explode(',', $address);
                    if (sizeof($address_parts) >= 5) {
                        $data['headquarters_address']['street'] = trim($address_parts[0]);
                        $data['headquarters_address']['ward'] = trim($address_parts[1]);
                        $data['headquarters_address']['district'] = trim($address_parts[2]);
                        $data['headquarters_address']['city'] = " " . trim($address_parts[3]);
                        $data['headquarters_address']['country'] = trim($address_parts[4]);
                    }
                } elseif (strpos($line, 'Điện thoại') !== false) {

                    if (isset($dataArray[$i + 1]) && strpos($dataArray[$i + 1], ':') !== false) {
                        $value = trim($dataArray[$i]) . " " . trim($dataArray[$i + 1]);
                    } else  if (isset($dataArray[$i + 2]) && strpos($dataArray[$i + 2], ':') !== false) {
                        $value = trim($dataArray[$i]) . " " . trim($dataArray[$i + 1]) . " " . trim($dataArray[$i + 2]);;
                    } else {
                        $value = trim($dataArray[$i]);
                    }
                    $legal_representative = explode(':', $value);
                    if (sizeof($legal_representative) >= 2) {
                        $data['headquarters_address']['phone'] =  trim(str_replace('Fax', '', $legal_representative[1]));
                    }
                    // $data['headquarters_address']['phone'] = trim(str_replace('fax', '', $line));
                }
                if (preg_match('/Fax:(\d+)/', $line, $matches)) {
                    $data['headquarters_address']['fax'] = trim(str_replace('Fax:', '', $matches[1]));
                } elseif (strpos($line, 'Email') !== false) {
                    if (isset($dataArray[$i + 1]) && strpos($dataArray[$i + 1], ':') !== false) {
                        $value = trim($dataArray[$i]) . " " . trim($dataArray[$i + 1]);
                    } else  if (isset($dataArray[$i + 2]) && strpos($dataArray[$i + 2], ':') !== false) {
                        $value = trim($dataArray[$i]) . " " . trim($dataArray[$i + 1]) . " " . trim($dataArray[$i + 2]);;
                    } else {
                        $value = trim($dataArray[$i]);
                    }
                    $legal_representative = explode(':', $dataArray[$i]);
                    if (sizeof($legal_representative) >= 2) {
                        print_r($line);
                        $data['headquarters_address']['Email'] =  trim(str_replace('', '', $legal_representative[1]));
                    }
                    // $data['headquarters_address']['Email'] = trim(str_replace('Email:', '', $line));
                }
                if (preg_match('/Website:(\S+)/', $line, $matches)) {
                    $data['headquarters_address']['website'] = trim($matches[1]);
                } elseif (strpos($line, 'Ngày thành lập') !== false) {

                    if (isset($dataArray[$i + 1]) && strpos($dataArray[$i + 1], ':') !== false) {
                        $value = trim($dataArray[$i]) . " " . trim($dataArray[$i + 1]);
                    } else  if (isset($dataArray[$i + 2]) && strpos($dataArray[$i + 2], ':') !== false) {
                        $value = trim($dataArray[$i]) . " " . trim($dataArray[$i + 1]) . " " . trim($dataArray[$i + 2]);;
                    } else {
                        $value = trim($dataArray[$i]);
                    }
                    $legal_representative = explode(':', $value);
                    if (sizeof($legal_representative) >= 2) {
                        $data['establishment_date'] =  trim(str_replace('4. Địa chỉ trụ sở chính', '', $legal_representative[1]));
                    }

                    //trim(str_replace('Ngày; thành lập:', '', $line));
                } elseif (strpos($line, 'Ngành, nghề kinh doanh') !== false) {
                    continue;
                } elseif (strpos($line, ' VNĐ') !== false) {
                    $charter_capital = explode(':', $line);
                    if (sizeof($charter_capital) >= 2) {
                        $data['charter_capital'] = trim($charter_capital[1]);
                    }
                }
            }
        }
        // table
        for ($i =  0; $i < sizeof($dataArray); $i++) {
            $line = trim($dataArray[$i]);
            if (strpos($line, 'STT Tên ngành Mã ngành') !== false) {
                $position = $i;
                for ($i =  $position; $i < sizeof($dataArray); $i++) {
                    $arr = trim($dataArray[$i]);
                    if (strpos($arr, 'Vốn điều lệ') !== false) {
                        break;
                    } else {


                        if (strpos($arr, 'Thời gian đăng') !== false) {
                            continue;
                        } else {
                            if (preg_match('/\s(\d+)/', $arr, $matches)) {
                                $data['business_lines'][] = [
                                    'industry_code' =>  $matches[1]
                                ];
                            }

                            if (strpos($arr, '(Chính)') !== false) {
                                preg_match('/\s(\d+)\D/', $arr, $matches);
                                $data['business_lines']['main_industry_code'] = trim(str_replace('(Chính)', '', $matches[1]));
                            }
                        }
                    }
                }
            }
        }
        // end table

        // owner info
        for ($i =  0; $i < sizeof($dataArray); $i++) {
            $line = trim($dataArray[$i]);
            if (strpos($line, 'Thông tin về chủ sở hữu') !== false) {
                $position = $i;
                for ($i =  $position; $i < sizeof($dataArray); $i++) {
                    $line = trim($dataArray[$i]);
                    if (strpos($line, 'Họ và tên') !== false && strpos($line, '* Họ và tên') == false) {
                        $parts = explode(':', $line);
                        if (sizeof($parts) >= 2) {
                            $data['owner_info']['full_name'] = trim(str_replace('Giới tính', '', $parts[1]));;
                        }
                        // $data['owner_info']['full_name'] = trim(str_replace('Họ và tên:', '', $line));
                    }
                    if (preg_match('/Giới tính:\s*(\w+)/', $line, $matches)) {
                        $data['owner_info']['sex'] = trim(str_replace('Giới tính:', '', $matches[1]));
                    }
                    if (preg_match('/Sinh ngày: (\d{2}\/\d{2}\/\d{4})/', $line, $matches)) {
                        $data['owner_info']['dayofbirthday'] = trim(str_replace('Sinh ngày:', '', $matches[1]));
                    }
                    if (preg_match('/Dân tộc:\s*(\w+)/', $line, $matches)) {
                        $data['owner_info']['ethnicity'] = trim(str_replace('Dân tộc:', '', $matches[1]));
                    }
                    if (preg_match('/Quốc tịch:\s*([\p{L}\s]+)/u', $line, $matches)) {
                        $data['owner_info']['nationality'] = trim(str_replace('Quốc tịch:', '', $matches[1]));
                    } elseif (strpos($line, 'Loại giấy tờ pháp lý của cá nhân') !== false) {
                        $parts = explode(':', $line);
                        if (sizeof($parts) >= 2) {
                            $data['owner_info']['legal_document_type'] = $parts[1];
                        }
                    } elseif (strpos($line, 'Số giấy tờ pháp lý của cá nhân') !== false) {
                        $parts = explode(':', $line);
                        if (sizeof($parts) >= 2) {
                            $data['owner_info']['legal_document_number'] = $parts[1];
                        }
                        $data['owner_info']['legal_document_number'] = trim(str_replace('Số giấy tờ pháp lý của cá nhân: ', ' ', $line));
                    }
                    if (preg_match('/Ngày cấp: (\d{2}\/\d{2}\/\d{4})/', $line, $matches)) {
                        $data['owner_info']['legal_document_date'] = trim(str_replace('Ngày cấp: ', '', $matches[1]));
                    }
                    if (preg_match('/Nơi cấp:\s*(.*)(\n|$)/', $line, $matches)) {
                        $data['owner_info']['legal_document_place'] = trim($matches[1]);
                    } elseif (strpos($line, 'Địa chỉ thường trú') !== false) {
                        if (strpos($dataArray[$i + 1], ':') !== false) {
                            $legal = trim($dataArray[$i]);
                        } else {
                            $legal = trim($dataArray[$i]) . "  " . trim($dataArray[$i + 1]);
                        }
                        $legal_representative = explode(':', $legal);
                        if (sizeof($legal_representative) >= 2) {
                            $data['owner_info']['permanent_address'] = $legal_representative[1];
                        }
                    } elseif (strpos($line, 'Địa chỉ liên lạc') !== false) {
                        if (strpos($dataArray[$i + 1], ':') !== false) {
                            $legal = trim($dataArray[$i]);
                        } else {
                            $legal = trim($dataArray[$i]) . " " . trim($dataArray[$i + 1]);
                        }
                        $legal_representative = explode(':', $legal);
                        if (sizeof($legal_representative) >= 2) {
                            $data['owner_info']['contact_address'] = trim($legal_representative[1]);
                        }
                    }
                    // echo '<pre>';
                    // print_r($dataArray[$i]);
                    if (strpos($line, 'Người đại diện theo pháp luật') !== false) {
                        break;
                    }
                }
            }
        }
        //end owner info
        // legal representative 
        for ($i =  0; $i < sizeof($dataArray); $i++) {
            $line = trim($dataArray[$i]);
            if (preg_match('/Họ và tên:\s*([^\n:]+)/', $line, $matches)) {
                $data['legal_representative']['full_name'] = trim(str_replace('Giới tính', '', $matches[1]));
            } elseif (strpos($line, 'Chức danh') !== false) {
                $data['legal_representative']['position'] = trim(str_replace('Chức danh:', '', $line));
            }
            if (preg_match('/Giới tính:\s*(\w+)/', $line, $matches)) {
                $data['legal_representative']['sex'] = trim(str_replace('Giới tính:', '', $matches[1]));
            }
            if (preg_match('/Sinh ngày: (\d{2}\/\d{2}\/\d{4})/', $line, $matches)) {
                $data['legal_representative']['dayofbirthday'] = trim(str_replace('Sinh ngày:', '', $matches[1]));
            }
            if (preg_match('/Dân tộc:\s*(\w+)/', $line, $matches)) {
                $data['legal_representative']['ethnicity'] = trim(str_replace('Dân tộc:', '', $matches[1]));
            }
            if (preg_match('/Quốc tịch:\s*([\p{L}\s]+)/u', $line, $matches)) {
                $data['legal_representative']['nationality'] = trim(str_replace('Quốc tịch:', '', $matches[1]));
            } elseif (strpos($line, 'Loại giấy tờ pháp lý của cá nhân') !== false) {
                $data['legal_representative']['legal_document_type'] = trim(str_replace('Loại giấy tờ pháp lý của cá nhân: ', '', $line));
            } elseif (strpos($line, 'Số giấy tờ pháp lý của cá nhân') !== false) {
                $legal_representative = explode(':', $line);
                if (sizeof($legal_representative) >= 2) {
                    $data['legal_representative']['legal_document_number'] = trim($legal_representative[1]);
                }
                // $data['legal_representative']['legal_document_number'] = trim($line);
            }
            if (preg_match('/Ngày cấp: (\d{2}\/\d{2}\/\d{4})/', $line, $matches)) {
                $data['legal_representative']['legal_document_date'] = trim(str_replace('Ngày cấp: ', '', $matches[1]));
            }
            if (preg_match('/Nơi cấp:\s*(.*)(\n|$)/', $line, $matches)) {
                $data['legal_representative']['legal_document_place'] = trim($matches[1]);
            } elseif (strpos($line, 'Địa chỉ thường trú') !== false) {
                if (strpos($dataArray[$i + 1], ':') !== false) {
                    $legal = trim($dataArray[$i]);
                } else {
                    $legal = trim($dataArray[$i]) . "  " . trim($dataArray[$i + 1]);
                }
                $legal_representative = explode(':', $legal);
                if (sizeof($legal_representative) >= 2) {
                    $data['legal_representative']['permanent_address'] = $legal_representative[1];
                }
            } elseif (strpos($line, 'Địa chỉ liên lạc') !== false) {
                if (strpos($dataArray[$i + 1], ':') !== false) {
                    $legal = trim($dataArray[$i]);
                } else {
                    $legal = trim($dataArray[$i]) . " " . trim($dataArray[$i + 1]);
                }
                $legal_representative = explode(':', $legal);
                if (sizeof($legal_representative) >= 2) {
                    $data['legal_representative']['contact_address'] = trim($legal_representative[1]);
                }
            }
            if (strpos($arr, 'Người đại diện theo pháp luật') !== false) {
                break;
            }
        }

        //end owner info legal representative
        for ($i =  0; $i < sizeof($dataArray); $i++) {
            $line = trim($dataArray[$i]);
            if (strpos($line, 'Nơi đăng ký') !== false) {
                $legal_representative = explode(':', $line);
                if (sizeof($legal_representative) >= 2) {
                    $data['registration_office'] = $legal_representative[1];
                }
            }
        }
        // $jsonData = json_encode($data, JSON_UNESCAPED_UNICODE);


        // $newFilename =   $newName  . $today . '.json'; // your new JSON file name
        // // Storage::put($newFilename, $jsonData);
        // Storage::delete($newName  . $today . '.txt');
        echo '<pre>';
        print_r($data);
        // Return the processed data along with the file name
        return [
            'data' => $data,
        ];
    }
}
