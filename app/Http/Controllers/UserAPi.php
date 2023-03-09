<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class UserAPi extends Controller
{
    public function index()
    {
        return view('usertoapi');
    }
    // public function getkeyapi()
    // {
    //     $user = Auth::user();
    //     // Create an API token for the user
    //     $apiToken = $user->createToken('My API Token')->plainTextToken;
    //     return $apiToken;
    // }
    public function sumbitapi(Request $request)
    {
        // ...
        // Get the user
        // Create an API token for the user
        // $apiToken = $this->getkeyapi();
        $file =   $request->file('file');
        // Set up the API endpoint URL
        $url = 'https://a56f-14-169-241-25.ap.ngrok.io/api/process-file';
        $filePath = $file->getRealPath();
        // Set up the API request data
        $data = [
            'file' => base64_encode(file_get_contents($filePath)),
        ];

        // Set up the API request headers
        $headers = [
            'Authorization: Bearer ',
            'Content-Type: application/json',
        ];

        // Make the API request using Laravel's HTTP client
        $response = Http::withHeaders($headers)
            ->post($url, $data);

        // Check for any errors
        if ($response->failed()) {
            $error = $response->body();
            // Handle the error
        } else {
            $responseData = $response->json();
            if ($responseData['status'] === 'error') {
                $errorMessage = $responseData['message'];
                // Handle the API error
            } else {
                $output = $responseData['output'];
                // Do something with the output
            }
        }
    }
}
