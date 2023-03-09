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
        $pdfPath = 'assets/upload/pdf-convert.pdf';
        $texts = (new Pdf(getenv('PDFTOTEXT_PATH')))->setPdf($pdfPath)->text();
        // $parser = new Parser();
        // $pdf    = $parser->parseFile('upload/pdf/pdf-convert.pdf');
        // $texts   = $pdf->getText();
        // $texts = new Pdf(getenv('PDFTOTEXT_PATH'));
        // $texts->getText('upload/pdf/pdf-convert.pdf'); 

        //   echo Pdf::getText($pdfPath, $pdftotextPath);
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
        $key_arr = ['company_name'=>['vietnamese', 'foreign', 'abbreviation'], ['tax_code'], ['establishment_date'], 'headquarters_address'=>['address', 'phone', 'fax', 'Email', 'website'], 'business_lines'=>['main_industry_code', 'industry_code'], ['charter_capital'],'owner_info'=> ['owner_info', 'full_name', 'sex', 'dayofbirthday', 'ethnicity', 'nationality', 'legal_document_type', 'legal_document_number', 'legal_document_date', 'legal_document_place', 'permanent_address', 'contact_address'], 'legal_representative'=>['legal_representative', 'full_name', 'sex', 'position', 'dayofbirthday', 'ethnicity', 'nationality', 'legal_document_type', 'legal_document_number', 'legal_document_date', 'legal_document_place', 'permanent_address', 'contact_address'], 'registration_office'=>['registration_office']];
        $group = 'company_name';
        $key = '';
        $group_arr = ['company_name', 'tax_code', 'establishment_date', 'headquarters_address', 'business_lines', 'charter_capital', 'owner_info', 'legal_representative', 'registration_office'];

        $pattern = '/\d+\.\s+/'; // matches digits followed by a dot and one or more spaces
        $replacement = ''; // replace with empty string
        for ($i =  0; $i < sizeof($dataArray); $i++) {
            $line = trim($dataArray[$i]);
            // Check if the line contains a colon (':')
            if (strpos($line, ':') !== false) {
                if (strpos($line, 'Mã số doanh nghiệp') !== false) {
                    break;
                } else {
                    $parts = explode(':', $line, 2);
                    if (strpos($line, '. ') !== false) {
                        $group =   $group_arr[Str::slug(pathinfo(trim($line), PATHINFO_FILENAME), '_') * 1 - 1];
                    }
                    // Split the line into key and value
                    $key = trim($parts[0]);
                    $value = trim($parts[1]);
                    // Add the key-value pair to the data array
                    $data[$group][Str::slug(pathinfo($key, PATHINFO_FILENAME), '_')] = $value;
                }
            }
        }
        // 2 - 7
        $iKey = 0;
        for ($i =  0; $i < sizeof($dataArray); $i++) {
            $line = trim($dataArray[$i]);

            if (strpos($line, 'Mã số doanh nghiệp') !== false) {
                $position = $i;
                for ($i =  $position; $i < sizeof($dataArray); $i++) {
                    $line = trim($dataArray[$i]);
                    // Check if the line contains a colon (':')
                    if (strpos($line, ':') !== false) {
                        // if (strpos($line, 'Người đại diện theo pháp luật') !== false) {
                        //     break;
                        // } else 
                        if (strpos($line, 'Vốn điều lệ') !== false || strpos($line, 'Ngành, nghề kinh doanh') !== false || strpos($line, 'Ngày thành lập') !== false || strpos($line, 'Mã số doanh nghiệp') !== false || strpos($line, 'Chi tiết') !== false) {
                            continue;
                        } else {
                            $parts = explode(':', $line, 2);
                            if (is_numeric(Str::slug(pathinfo(trim($line), PATHINFO_FILENAME), '_'))) {
                                if (strpos($line, '. ') !== false) {
                                    $group =   $group_arr[Str::slug(pathinfo(trim($line), PATHINFO_FILENAME), '_') * 1 - 1];
                                    $key = '';
                                    
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
                }
            }
        }
        // table

        for ($i =  0; $i < sizeof($dataArray); $i++) {
            $line = trim($dataArray[$i]);
            if (strpos($line, 'Chi tiết:') !== false) {
                $position = $i;
                for ($i =  $position; $i < sizeof($dataArray); $i++) {
                    $arr = trim($dataArray[$i]);
                    if (strpos($arr, 'Thông tin về chủ sở hữu') !== false) {
                        break;
                    } else {
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
                    }
                }
            }
        }
        // end table

        // data can xu bat ng tat
        // xu ly mục 1 -4 and 6 
        for ($i = 0; $i < sizeof($dataArray); $i++) {
            $line = trim($dataArray[$i]);
            if (!empty($line)) {
                if (strpos($line, 'Mã số doanh nghiệp') !== false) {

                    $data['tax_code'] = trim($dataArray[$i - 1]);
                } elseif (strpos($line, 'Ngày thành lập') !== false) {
                    $data['establishment_date'] = trim($dataArray[$i - 1]);
                } elseif (strpos($line, ' VNĐ') !== false) {
                    $data['charter_capital'] = trim($line);
                }
            }
        }
        //end data

        $jsonData = json_encode($data, JSON_UNESCAPED_UNICODE);
        // save the JSON to a new file
        // $newFilename = 'file.json'; // your new JSON file name
        // Storage::put($newFilename, $jsonData);
        Storage::delete('converted-text.txt');
        //   Return a view with the JSON data
        return view('convert', [
            'output' => $data,
            'arr' => $dataArray
        ]);
    }
    // public function processFile($file)
    // {
    //     // Store the file in the storage folder
    //     // $path = $file->store('public');

    //     // Get the original file name
    //     $fileName = $file->getClientOriginalName();

    //     // Process the file using any third-party libraries or tools
    //     $pdftotextPath = getenv('PDFTOTEXT_PATH');
    //     $fileName = $file->getClientOriginalName();
    //     // Get the path to the temporary file created by Laravel
    //     $filePath = $file->getRealPath();
    //     // Remove any special characters from the file name
    //     $cleanName = Str::slug(pathinfo($fileName, PATHINFO_FILENAME), '-');

    //     // Get the file extension
    //     $extension = $file->getClientOriginalExtension();

    //     // Create the new file name
    //     $newName = $cleanName . '.' . $extension;

    //     $process = new Process([$pdftotextPath, $filePath]);
    //     $process->run();

    //     if (!$process->isSuccessful()) {
    //         throw new ProcessFailedException($process);
    //     }
    //     $texts = (new Pdf(getenv('PDFTOTEXT_PATH')))->setPdf($filePath)->text();

    //     // end xu ly file

    //     date_default_timezone_set("Asia/Ho_Chi_Minh");
    //     $mydate = getdate(date("U"));
    //     $today = "$mydate[year]$mydate[mon]$mydate[mday]$mydate[hours]$mydate[minutes]$mydate[seconds]";

    //     //   echo Pdf::getText($pdfPath, $pdftotextPath);
    //     $files = storage_path('app/' .  $newName  . $today . '.txt');
    //     file_put_contents($files, $texts);
    //     // txt to json
    //     $filePath = storage_path('app/' . $newName  . $today . '.txt');
    //     $text = file_get_contents($filePath);
    //     $encoding = mb_detect_encoding($text);
    //     // set utf 8
    //     $utf8Text = iconv($encoding, 'UTF-8', $text);
    //     $dataArray = explode("\n", $utf8Text);
    //     $dataArray =  str_replace("\r", "", $dataArray);
    //     // create data 
    //     $data = [
    //         "company_name" => [
    //             "vietnamese" => "",
    //             "foreign" => "",
    //             "abbreviation" => ""
    //         ],
    //         "tax_code" => "",
    //         "establishment_date" => "",
    //         "headquarters_address" => [
    //             "street" => "",
    //             "ward" => "",
    //             "district" => "",
    //             "city" => "",
    //             "country" => "Vietnam",
    //             "phone" => "",
    //             "fax" => "",
    //             "Email" => "",
    //             "website" => ""
    //         ],
    //         "business_lines" => [
    //             'main_industry_code' => ''

    //         ],
    //         "charter_capital" => "",
    //         "owner_info" => [
    //             "full_name" => "",
    //             "gender" => "",
    //             "dayofbirthday" => "",
    //             "ethnicity" => "",
    //             "nationality" => "Vietnam",
    //             "legal_document_type" => "",
    //             "legal_document_number" => "",
    //             "legal_document_date" => "",
    //             "legal_document_place" => "",
    //             "permanent_address" => "",
    //             "contact_address" => ""
    //         ],
    //         "legal_representative" => [
    //             "full_name" =>  "",
    //             "gender" => "",
    //             "position" =>  "",
    //             "birthday" =>  "",
    //             "ethnicity" =>  "",
    //             "nationality" =>  "",
    //             "legal_document_type" =>  "",
    //             "legal_document_number" =>  "",
    //             "legal_document_date" =>  "",
    //             "legal_document_place" =>  "",
    //             "permanent_address" =>  "",
    //             "contact_address" =>  ""
    //         ],
    //         "registration_office" =>  ""
    //     ];
    //     // xu ly mục 1 -4 and 6 
    //     for ($i = 0; $i < sizeof($dataArray); $i++) {
    //         $line = trim($dataArray[$i]);
    //         if (!empty($line)) {
    //                     // Split the line by the colon
    //                     $parts = explode(':', $line, 2);
    //         if (strpos($line, 'CÔNG BỐ NỘI DUNG ĐĂNG KÝ THÀNH LẬP MỚI') !== false) {
    //             continue;
    //         }

    //         if (strpos($line, 'Mã số doanh nghiệp') !== false) {

    //             $data['tax_code'] = trim($dataArray[$i - 1]);
    //             //    trim(str_replace('Mã số doanh nghiệp:', '', $line));
    //         } elseif (strpos($line, 'Tên công ty viết bằng tiếng Việt') !== false) {
    //             $data['company_name']['vietnamese'] = trim(str_replace('Tên công ty viết bằng tiếng Việt:', '', $line));
    //         } elseif (strpos($line, 'Tên công ty viết bằng tiếng nước ngoài') !== false) {
    //             $data['company_name']['foreign'] = trim(str_replace('Tên công ty viết bằng tiếng nước ngoài:', '', $line));
    //         } elseif (strpos($line, 'Tên công ty viết tắt') !== false) {
    //             $data['company_name']['abbreviation'] = trim(str_replace('Tên công ty viết tắt:', '', $line));
    //         } 
    //          elseif (strpos($line, 'Địa chỉ trụ sở chính') !== false) {
    //             $address = trim($dataArray[$i + 1]) . trim($dataArray[$i + 2]);
    //             $address_parts = explode(',', $address);
    //             if (sizeof($address_parts) >= 4) {
    //                 $data['headquarters_address']['street'] = trim($address_parts[0]);
    //                 $data['headquarters_address']['ward'] = trim($address_parts[1]);
    //                 $data['headquarters_address']['district'] = trim($address_parts[2]);
    //                 $data['headquarters_address']['city'] = trim($address_parts[3]); # code...
    //             }
    //         } elseif (strpos($line, 'Điện thoại') !== false) {
    //             $data['headquarters_address']['phone'] = trim(str_replace('Điện thoại:', '', $line));
    //         } elseif (strpos($line, 'Fax') !== false) {
    //             $data['headquarters_address']['fax'] = trim(str_replace('Fax:', '', $line));
    //         } elseif (strpos($line, 'Email') !== false) {
    //             $data['headquarters_address']['Email'] = trim(str_replace('Email:', '', $line));
    //         } elseif (strpos($line, 'Điện thoại') !== false) {
    //             $data['headquarters_address']['website'] = trim(str_replace('Website:', '', $line));
    //         } elseif (strpos($line, 'Ngày thành lập') !== false) {
    //             $data['establishment_date'] = trim($dataArray[$i - 1]);

    //             //trim(str_replace('Ngày; thành lập:', '', $line));
    //         }elseif (strpos($line, 'Ngành, nghề kinh doanh') !== false) {
    //             continue;
    //         } elseif (strpos($line, ' VNĐ') !== false) {
    //             $data['charter_capital'] = trim($line);
    //         }
    //     }
    //     }
    //     // table
    //     for ($i =  0; $i < sizeof($dataArray); $i++) {
    //         $line = trim($dataArray[$i]);
    //         if (strpos($line, 'Chi tiết:') !== false) {
    //             $position = $i;
    //             for ($i =  $position; $i < sizeof($dataArray); $i++) {
    //                 $arr = trim($dataArray[$i]);
    //                 if (is_numeric($dataArray[$i])) {
    //                     if (strpos($arr, '.') === false) {
    //                         $data['business_lines'][] = [
    //                             'industry_code' => $dataArray[$i]
    //                         ];
    //                     }
    //                 }
    //                 if (strpos($arr, '(Chính)') !== false) {
    //                     $data['business_lines']['main_industry_code'] = trim(str_replace('(Chính)', '', $arr));
    //                 }
    //                 if (strpos($arr, 'Thông tin về chủ sở hữu') !== false) {
    //                     break;
    //                 }
    //             }
    //         }
    //     }
    //     // end table

    //     // owner info
    //     for ($i =  0; $i < sizeof($dataArray); $i++) {
    //         $line = trim($dataArray[$i]);
    //         if (strpos($line, 'Thông tin về chủ sở hữu') !== false) {
    //             $position = $i;
    //             for ($i =  $position; $i < sizeof($dataArray); $i++) {
    //                 $line = trim($dataArray[$i]);
    //                 if (strpos($line, 'Họ và tên') !== false && strpos($line, '* Họ và tên') == false) {
    //                     $parts = explode(':', $line);
    //                     if (sizeof($parts) >= 2) {
    //                         $data['owner_info']['full_name'] = $parts[1];
    //                     }
    //                     // $data['owner_info']['full_name'] = trim(str_replace('Họ và tên:', '', $line));
    //                 } elseif (strpos($line, 'Giới tính') !== false) {
    //                     $data['owner_info']['gender'] = trim(str_replace('Giới tính:', '', $line));
    //                 } elseif (strpos($line, 'Sinh ngày') !== false) {
    //                     $data['owner_info']['dayofbirthday'] = trim(str_replace('Sinh ngày:', '', $line));
    //                 } elseif (strpos($line, 'Dân tộc') !== false) {
    //                     $data['owner_info']['ethnicity'] = trim(str_replace('Dân tộc:', '', $line));
    //                 } elseif (strpos($line, 'Quốc tịch') !== false) {
    //                     $data['owner_info']['nationality'] = trim(str_replace('Quốc tịch:', '', $line));
    //                 } elseif (strpos($line, 'Loại giấy tờ pháp lý của cá nhân') !== false) {
    //                     $parts = explode(':', $line);
    //                     if (sizeof($parts) >= 2) {
    //                         $data['owner_info']['legal_document_type'] = $parts[1];
    //                     }
    //                 } elseif (strpos($line, 'Số giấy tờ pháp lý của cá nhân') !== false) {
    //                     $parts = explode(':', $line);
    //                     if (sizeof($parts) >= 2) {
    //                         $data['owner_info']['legal_document_number'] = $parts[1];
    //                     }
    //                     $data['owner_info']['legal_document_number'] = trim(str_replace('Số giấy tờ pháp lý của cá nhân: ', ' ', $line));
    //                 } elseif (strpos($line, 'Ngày cấp') !== false) {
    //                     $data['owner_info']['legal_document_date'] = trim(str_replace('Ngày cấp: ', '', $line));
    //                 } elseif (strpos($line, 'Nơi cấp') !== false) {
    //                     if (strpos($dataArray[$i + 1], ':') !== false) {
    //                         $legal = trim($dataArray[$i]);
    //                     } else {
    //                         $legal = trim($dataArray[$i]) . " " . trim($dataArray[$i + 1]);
    //                     }
    //                     $legal_representative = explode(':', $legal);
    //                     if (sizeof($legal_representative) >= 2) {
    //                         $data['owner_info']['legal_document_place'] = trim($legal_representative[1]);
    //                     }
    //                 } elseif (strpos($line, 'Địa chỉ thường trú') !== false) {
    //                     if (strpos($dataArray[$i + 1], ':') !== false) {
    //                         $legal = trim($dataArray[$i]);
    //                     } else {
    //                         $legal = trim($dataArray[$i]) . "  " . trim($dataArray[$i + 1]);
    //                     }
    //                     $legal_representative = explode(':', $legal);
    //                     if (sizeof($legal_representative) >= 2) {
    //                         $data['owner_info']['permanent_address'] = $legal_representative[1];
    //                     }
    //                 } elseif (strpos($line, 'Địa chỉ liên lạc') !== false) {
    //                     if (strpos($dataArray[$i + 1], ':') !== false) {
    //                         $legal = trim($dataArray[$i]);
    //                     } else {
    //                         $legal = trim($dataArray[$i]) ." ". trim($dataArray[$i + 1]);
    //                     }
    //                     $legal_representative = explode(':', $legal);
    //                     if (sizeof($legal_representative) >= 2) {
    //                         $data['owner_info']['contact_address'] = trim($legal_representative[1]);
    //                     }
    //                 }
    //                 // echo '<pre>';
    //                 // print_r($dataArray[$i]);
    //                 if (strpos($line, 'Người đại diện theo pháp luật') !== false) {
    //                     break;
    //                 }
    //             }
    //         }
    //     }
    //     //end owner info
    //     // legal representative 
    //     for ($i =  0; $i < sizeof($dataArray); $i++) {
    //         $line = trim($dataArray[$i]);
    //         if (strpos($line, '* Họ và tên') !== false) {
    //             $parts = explode(':', $line);
    //             if (sizeof($parts) >= 2) {
    //                 $data['legal_representative']['full_name'] = $parts[1];
    //             }
    //             // $data['legal_representative']['full_name'] = trim(str_replace('* Họ và tên:', '', $line));
    //         } elseif (strpos($line, 'Chức danh') !== false) {
    //             $data['legal_representative']['position'] = trim(str_replace('Chức danh:', '', $line));
    //         } elseif (strpos($line, 'Giới tính') !== false) {
    //             $data['legal_representative']['gender'] = trim(str_replace('Giới tính:', '', $line));
    //         } elseif (strpos($line, 'Sinh ngày') !== false) {
    //             $parts = explode(':', $line);
    //             if (sizeof($parts) >= 2) {

    //                 $data['legal_representative']['birthday'] = $parts[1];
    //             }
    //             //    $data['legal_representative']['birthday'] = trim(str_replace('Sinh ngày:', '', $line));
    //         } elseif (strpos($line, 'Dân tộc') !== false) {
    //             $data['legal_representative']['ethnicity'] = trim(str_replace('Dân tộc:', '', $line));
    //         } elseif (strpos($line, 'Quốc tịch') !== false) {
    //             $data['legal_representative']['nationality'] = trim(str_replace('Quốc tịch:', '', $line));
    //         } elseif (strpos($line, 'Loại giấy tờ pháp lý của cá nhân') !== false) {
    //             $data['legal_representative']['legal_document_type'] = trim(str_replace('Loại giấy tờ pháp lý của cá nhân: ', '', $line));
    //         } elseif (strpos($line, 'Số giấy tờ pháp lý của cá nhân') !== false) {
    //             if ($dataArray[$i + 1] != "") {
    //                 $data['legal_representative']['legal_document_number'] = trim($dataArray[$i + 1]);
    //             } else   if ($dataArray[$i + 2] != "") {
    //                 $data['legal_representative']['legal_document_number'] = trim($dataArray[$i + 2]);
    //             } else {
    //                 $data['legal_representative']['legal_document_number'] = trim(str_replace('Số giấy tờ pháp lý của cá nhân: ', '', $line));
    //             }
    //         } elseif (strpos($line, 'Ngày cấp') !== false) {
    //             if ($dataArray[$i + 1] != "") {
    //                 $data['legal_representative']['legal_document_date'] = trim($dataArray[$i + 1]);
    //             } else   if ($dataArray[$i + 2] != "") {
    //                 $data['legal_representative']['legal_document_date'] = trim($dataArray[$i + 2]);
    //             } else {
    //                 $data['legal_representative']['legal_document_date'] = trim(str_replace('Ngày cấp: ', '', $line));
    //             }
    //         } elseif (strpos($line, 'Nơi cấp') !== false) {
    //             if (strpos($dataArray[$i + 1], ':') !== false) {
    //                 $legal = trim($dataArray[$i]);
    //             } else {
    //                 $legal = trim($dataArray[$i]) . " " . trim($dataArray[$i + 1]);
    //             }
    //             $legal_representative = explode(':', $legal);
    //             if (sizeof($legal_representative) >= 2) {
    //                 $data['legal_representative']['legal_document_place'] = trim($legal_representative[1]);
    //             }
    //         } elseif (strpos($line, 'Địa chỉ thường trú') !== false) {
    //             if (strpos($dataArray[$i + 1], ':') !== false) {
    //                 $legal = trim($dataArray[$i]);
    //             } else {
    //                 $legal = trim($dataArray[$i]) . "  " . trim($dataArray[$i + 1]);
    //             }
    //             $legal_representative = explode(':', $legal);
    //             if (sizeof($legal_representative) >= 2) {
    //                 $data['legal_representative']['permanent_address'] = $legal_representative[1];
    //             }
    //         } elseif (strpos($line, 'Địa chỉ liên lạc') !== false) {
    //             if (strpos($dataArray[$i + 1], ':') !== false) {
    //                 $legal = trim($dataArray[$i]);
    //             } else {
    //                 $legal = trim($dataArray[$i]) ." ". trim($dataArray[$i + 1]);
    //             }
    //             $legal_representative = explode(':', $legal);
    //             if (sizeof($legal_representative) >= 2) {
    //                 $data['legal_representative']['contact_address'] = trim($legal_representative[1]);
    //             }
    //         }
    //         if (strpos($arr, 'Người đại diện theo pháp luật') !== false) {
    //             break;
    //         }
    //     }
    //     //end owner info legal representative


    //     for ($i =  0; $i < sizeof($dataArray); $i++) {
    //         $line = trim($dataArray[$i]);
    //         if (strpos($line, 'Nơi đăng ký') !== false) {
    //             if ($dataArray[$i + 1] != "") {
    //                 $data['registration_office'] = trim($dataArray[$i + 1]);
    //             } else   if ($dataArray[$i + 2] != "") {
    //                 $data['registration_office'] = trim($dataArray[$i + 2]);
    //             }
    //         }
    //     }
    //     $jsonData = json_encode($data, JSON_UNESCAPED_UNICODE);


    //     $newFilename =   $newName  . $today . '.json'; // your new JSON file name
    //     // // Storage::put($newFilename, $jsonData);
    //     // Storage::delete($newName  . $today . '.txt');

    //     // Return the processed data along with the file name
    //     return [
    //         'data' => $data,
    //     ];
    // }
}
