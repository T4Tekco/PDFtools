<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
  
    public function QR_Code()
    {
        return view('client.QRVcrad');
    }
    public function QR_Code_url()
    {
        return view('client.qrCode');
    }

    public function Login()
    {
        return view('login');
    }
    public function SignUp()
    {
        return view('signup');
    }
    public function Profile()
    {
        return view('profile');
    }
    public function ChangePass()
    {
        return view('change_pass');
    }
    public function ForgotPass()
    {
        return view('forgot_pass');
    }
    public function AboutUs()
    {
        return view('about_us');
    }
    public function Contact()
    {
        return view('contact_us');
    }
    public function Tool()
    {
        return view('tool');
    }
    public function policy()
    {
        return view('policy');
    }
    public function term()
    {
        return view('term');
    }
    public function destroy($id)
    {
        //
    }
}
