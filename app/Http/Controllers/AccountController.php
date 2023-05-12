<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{

    public function Login()
    {
        if (session()->has('role')) {
            $redirectUrl = (session()->get('role') === 'admin') ? '/admin' : '/home';
            return redirect($redirectUrl);
        } else {
        
            return view('login');
        }
    }

    public function postlogin(Request $request)
{
    $user = new User();
    $username = $request->post('username');
    $password = $request->post('password');
    $checkUser = $user->login($username, $password);

    foreach ($checkUser as $row) {
        extract(get_object_vars($row));

        if ($username === $userName && $password === $password) {

            $request->session()->put('ID', $UserID);
            $request->session()->put('fullname', $FistName . " " . $LastName);
            $request->session()->put('role', $role);
            $redirectUrl = ($role === 'admin') ? '/admin' : '/';
            return redirect($redirectUrl);
        } else {
            echo 'Invalid credentials.';
        }
    }
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
}
