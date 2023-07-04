<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\PdfToText\Pdf;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;

class FileController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => '100',
            'message' => 'INPUT_DATA_INCORRECT',
        ])->header('Content-Type', 'application/json; charset=utf-8');
    }
    public function process(Request $request)
    {
        //    try {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048',
        ]);
        // Process the file and generate the required output
        $output = $this->processFile1($request->file('file'));

        // Return the output in JSON format
        return response()->json([
            'status' => '200',
            'output' => $output,
            // 'token' => Str::random(80)
        ]);
    }


    public function processFile1($file)
    {
        $pdfFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $textFile = $pdfFileName . ".txt";
        // create file
        putenv("JAVA_HOME=/usr/bin/java");
        // Storage::put($textFile, '  not found');
        $txtPath = storage_path('app/' . $textFile . '');
        $javaPath = '/usr/bin/java';
        $pdftotextPath = '/opt/pdfbox/pdfbox-app-3.0.0-alpha3.jar';
        $process = new Process([$javaPath, '-jar', $pdftotextPath, 'export:text', '-sort', '-console', '-i', $file]);
        // Run the command using the Symfony Process component
        $process->run();
        // Check if the command was successful, and handle any errors
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        $text = $process->getOutput();

        // end xu ly file
        Storage::put($textFile, $text);
        // txt to json
        $texts = storage_path('app/' . $textFile . '');
        $text = file_get_contents($texts);
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
            "business_code" => "",
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
                "dateofbirth" => "",
                "ethnicity" => "",
                "nationality" => "",
                "legal_document_type" => "",
                "legal_document_number" => "",
                "legal_document_date" => "",
                "legal_document_place" => "",

                "permanent_address" => [
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
                "contact_address" => [
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

            ],
            "legal_representative" => [
                "full_name" =>  "",
                "sex" => "",
                "position" =>  "",
                "dateofbirth" =>  "",
                "ethnicity" =>  "",
                "nationality" =>  "",
                "legal_document_type" =>  "",
                "legal_document_number" =>  "",
                "legal_document_date" =>  "",
                "legal_document_place" =>  "",
                "permanent_address" => [
                    "street" => "",
                    "ward" => "",
                    "district" => "",
                    "city" => "",
                    "country" => "",

                ],
                "contact_address" => [
                    "street" => "",
                    "ward" => "",
                    "district" => "",
                    "city" => "",
                    "country" => "",
                ],
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
                if (preg_match('/^2. Mã số doanh nghiệp:\s(.*)/',  $line, $matches)) {
                    $data['business_code'] =    trim($matches[1]);
                } elseif (preg_match('/^tên (công ty|doanh nghiệp) viết (bằng tiếng Việt|bằng tiếng nước ngoài|tắt):\s*(.*)/iu', $line, $matches)) {
                    $currentName = '';
                    $type = strtolower($matches[2]);
                    $name = trim($matches[3]);
                    $currentName =   $name;
                    if (preg_match('/^tên (công ty|doanh nghiệp) viết (bằng tiếng Việt|bằng tiếng nước ngoài|tắt):\s*(.*)/iu', $dataArray[$i + 1], $matches) == 0) {
                        $currentName .= ' ' . $dataArray[$i + 1];
                    }
                    switch ($type) {
                        case 'bằng tiếng việt':
                            $data['company_name']['vietnamese'] = trim(str_replace('Tên công ty viết bằng tiếng Việt:', '', $currentName));
                            break;
                        case 'bằng tiếng nước ngoài':
                            $data['company_name']['foreign'] = trim(str_replace('Tên công ty viết bằng tiếng nước ngoài:', '', $name));
                            break;
                        case 'tắt':
                            $data['company_name']['abbreviation'] = trim(str_replace('Tên công ty viết tắt:', '', $name));
                            break;
                    }
                } elseif (strpos($line, '4. Địa chỉ trụ sở chính') !== false) {
                    $address = trim(str_replace("4. Địa chỉ trụ sở chính: ", "", $dataArray[$i]));
                    if (isset($dataArray[$i + 1]) && strpos($dataArray[$i + 1], ':') === false) {
                        $address .= " " . trim($dataArray[$i + 1]);
                    }
                    if (isset($dataArray[$i + 2]) && strpos($dataArray[$i + 2], ':') === false) {
                        $address .= " " . trim($dataArray[$i + 2]);
                    }
                    if (isset($dataArray[$i + 3]) && strpos($dataArray[$i + 3], ':') === false) {
                        $address .= " " . trim($dataArray[$i + 3]);
                    }
                    // = $address;
                    $pattern = '/^(.*),\s*(.*),\s*(.*),\s*([^\d]+)$/u';
                    if (preg_match($pattern, $address, $matches)) {
                        $data['headquarters_address']['street'] = trim($matches[1]);
                        // $data['headquarters_address']['ward'] = trim($address_parts[1]);
                        $data['headquarters_address']['district'] = trim($matches[2]);
                        $data['headquarters_address']['city'] = trim($matches[3]);
                        $data['headquarters_address']['country'] = trim($matches[4]);
                    }
                } elseif (strpos($line, 'Điện thoại:') !== false) {
                    $value = trim($dataArray[$i]);
                    if (isset($dataArray[$i + 1]) && strpos($dataArray[$i + 1], ':') !== false) {
                        $value = trim($dataArray[$i]) . " " . trim($dataArray[$i + 1]);
                    }
                    $legal_representative = explode(':', $value);
                    if (sizeof($legal_representative) >= 2) {
                        $data['headquarters_address']['phone'] =  trim(str_replace('Fax', '', $legal_representative[1]));
                    }
                    // $data['headquarters_address']['phone'] = trim(str_replace('fax', '', $line));
                }
                if (preg_match('/Fax:(\d+)/', $line, $matches)) {
                    $data['headquarters_address']['fax'] = trim(str_replace('Fax:', '', $matches[1]));
                } else if ((preg_match('/(?:Email:)\s*([\w\-.+]+@[\w\-.]+)/i', $dataArray[$i], $matches))) {
                    $email = trim($matches[1]);

                    if (isset($dataArray[$i + 1]) && strpos($dataArray[$i + 1], '5. Ngành, nghề kinh doanh:') !== 0) {
                        $email .=  trim($dataArray[$i + 1]);
                    }

                    $data['headquarters_address']['Email'] =  $email;

                    // $data['headquarters_address']['Email'] = trim(str_replace('Email', '', $line));
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

            if (strpos($line, 'Họ và tên') !== false && strpos($line, '* Họ và tên') == false) {
                $parts = explode(':', $line);
                if (sizeof($parts) >= 2) {
                    $data['owner_info']['full_name'] = trim(str_replace('Giới tính', '', $parts[1]));;
                }
                // $data['owner_info']['full_name'] = trim(str_replace('Họ và tên:', '', $line));
            }
            if (preg_match('/Giới tính:\s*([^\n:]+)/', $line, $matches)) {
                $data['owner_info']['sex'] = trim(str_replace('Giới tính:', '', $matches[1]));
            }
            if (preg_match('/Sinh ngày: (\d{2}\/\d{2}\/\d{4})/', $line, $matches)) {
                $data['owner_info']['dateofbirth'] = trim(str_replace('Sinh ngày:', '', $matches[1]));
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

                $currentName   = trim($matches[1]);
                if (strpos($dataArray[$i + 1], ':') === false) {
                    $currentName .= ' ' .  $dataArray[$i + 1];
                }
                $data['owner_info']['legal_document_place'] = $currentName;
            } elseif (strpos($line, 'Địa chỉ thường trú') !== false) {

                $address = trim(str_replace("Địa chỉ thường trú: ", "", $dataArray[$i]));
                if (isset($dataArray[$i + 1]) && strpos($dataArray[$i + 1], ':') === false) {
                    $address .= " " . trim($dataArray[$i + 1]);
                }
                if (isset($dataArray[$i + 2]) && strpos($dataArray[$i + 2], ':') === false && strpos($dataArray[$i + 1], ':') === false) {
                    $address .= " " . trim($dataArray[$i + 2]);
                }

                $pattern = '/^(.*),\s*(.*),\s*(.*),\s*([^\d]+)$/u';
                if (preg_match($pattern, $address, $matches)) {
                    $data['owner_info']['permanent_address']['street'] = trim($matches[1]);
                    $data['owner_info']['permanent_address']['district'] = trim($matches[2]);
                    $data['owner_info']['permanent_address']['city'] = trim($matches[3]);
                    $data['owner_info']['permanent_address']['country'] = trim($matches[4]);
                }
            } elseif (strpos($line, 'Địa chỉ liên lạc') !== false) {
                // Địa chỉ liên lạc: 
                $address = trim(str_replace("Địa chỉ liên lạc: ", "", $dataArray[$i]));
                if (isset($dataArray[$i + 1]) && strpos($dataArray[$i + 1], '/') === false && strpos($dataArray[$i + 1], ':') === false) {
                    $address .= " " . trim($dataArray[$i + 1]);
                }
                if (isset($dataArray[$i + 2]) && strpos($dataArray[$i + 2], '/') === false && strpos($dataArray[$i + 2], ':') === false) {
                    $address .= " " . trim($dataArray[$i + 2]);
                }
                if (isset($dataArray[$i + 3]) && strpos($dataArray[$i + 3], '/') === false && strpos($dataArray[$i + 3], ':') === false) {
                    $address .= " " . trim($dataArray[$i + 3]);
                }
                $pattern = '/^(.*),\s*(.*),\s*(.*),\s*([^\d]+)$/u';
                if (preg_match($pattern, $address, $matches)) {
                    $data['owner_info']['contact_address']['street'] = trim($matches[1]);
                    $data['owner_info']['contact_address']['district'] = trim($matches[2]);
                    $data['owner_info']['contact_address']['city'] = trim($matches[3]);
                    $data['owner_info']['contact_address']['country'] = trim($matches[4]);
                }
            }
            // echo '<pre>';
            // print_r($dataArray[$i]);
            if (strpos($line, 'Người đại diện theo pháp luật') !== false) {
                break;
            }
            //    }
            //  }
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
            if (preg_match('/Giới tính:\s*([^\n:]+)/', $line, $matches)) {
                $data['legal_representative']['sex'] = trim(str_replace('Giới tính:', '', $matches[1]));
            }
            if (preg_match('/Sinh ngày: (\d{2}\/\d{2}\/\d{4})/', $line, $matches)) {
                $data['legal_representative']['dateofbirth'] = trim(str_replace('Sinh ngày:', '', $matches[1]));
            }
            if (preg_match('/Dân tộc:\s(.*?)(?=\s(?:Quốc tịch|Sinh ngày|$))/', $text, $matches)) {
                $data['legal_representative']['ethnicity'] = trim($matches[1]);
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
            }
            if (preg_match('/Ngày cấp: (\d{2}\/\d{2}\/\d{4})/', $line, $matches)) {
                $data['legal_representative']['legal_document_date'] = trim(str_replace('Ngày cấp: ', '', $matches[1]));
            }
            if (preg_match('/Nơi cấp:\s*(.*)(\n|$)/', $line, $matches)) {
                $cus_legal_document_place = trim($matches[1]);
                if (strpos($dataArray[$i + 1], 'Địa chỉ thường trú') === false) {
                    $cus_legal_document_place .= " " . trim($dataArray[$i + 1]);
                }
                $data['legal_representative']['legal_document_place'] = $cus_legal_document_place;
            } elseif (strpos($line, 'Địa chỉ thường trú') !== false) {

                $address = trim(str_replace("Địa chỉ thường trú: ", "", $dataArray[$i]));
                if (isset($dataArray[$i + 1]) && strpos($dataArray[$i + 1], ':') === false) {
                    $address .= " " . trim($dataArray[$i + 1]);
                }
                if (isset($dataArray[$i + 2]) && strpos($dataArray[$i + 2], ':') === false && strpos($dataArray[$i + 1], ':') === false) {
                    $address .= " " . trim($dataArray[$i + 2]);
                }

                $pattern = '/^(.*),\s*(.*),\s*(.*),\s*([^\d]+)$/u';
                if (preg_match($pattern, $address, $matches)) {
                    $data['legal_representative']['permanent_address']['street'] = trim($matches[1]);
                    $data['legal_representative']['permanent_address']['district'] = trim($matches[2]);
                    $data['legal_representative']['permanent_address']['city'] = trim($matches[3]);
                    $data['legal_representative']['permanent_address']['country'] = trim($matches[4]);
                }
            } elseif (strpos($line, 'Địa chỉ liên lạc') !== false) {
                $address = trim(str_replace("Địa chỉ liên lạc: ", "", $dataArray[$i]));
                if (isset($dataArray[$i + 1]) && strpos($dataArray[$i + 1], '/') === false && strpos($dataArray[$i + 1], ':') === false) {
                    $address .= " " . trim($dataArray[$i + 1]);
                }
                if (isset($dataArray[$i + 2]) && strpos($dataArray[$i + 2], '/') === false && strpos($dataArray[$i + 2], ':') === false) {
                    $address .= " " . trim($dataArray[$i + 2]);
                }
                if (isset($dataArray[$i + 3]) && strpos($dataArray[$i + 3], '/') === false && strpos($dataArray[$i + 3], ':') === false) {
                    $address .= " " . trim($dataArray[$i + 3]);
                }
                $pattern = '/^(.*),\s*(.*),\s*(.*),\s*([^\d]+)$/u';
                if (preg_match($pattern, $address, $matches)) {
                    $data['legal_representative']['contact_address']['street'] = trim($matches[1]);
                    $data['legal_representative']['contact_address']['district'] = trim($matches[2]);
                    $data['legal_representative']['contact_address']['city'] = trim($matches[3]);
                    $data['legal_representative']['contact_address']['country'] = trim($matches[4]);
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
        Storage::delete($textFile);
        // echo '<pre>';
        // print_r($data);
        // Return the processed data along with the file name
        return [
            'data' => $data,
        ];
    }
    public function extractAddressComponents($text)
    {
        $pattern = '/^Số (\d+)\s+(.*?),\s*Phường\s+(.*?),\s*Quận\s+(.*?),\s*Thành phố\s+(.*?),\s*Tỉnh\s+(.*?),\s*Việt Nam$/iu';
        $matches = [];

        if (preg_match($pattern, $text, $matches)) {
            $street = $matches[2];
            $city = $matches[5];
            $province = $matches[6];
            $country = $matches[7];

            return [
                "street" => $street,
                "city" => $city,
                "province" => $province,
                "country" => $country
            ];
        }

        // If the pattern doesn't match, you can return a default value or throw an exception
        return [
            "street" => "",
            "city" => "",
            "province" => "",
            "country" => ""
        ];
    }
}
