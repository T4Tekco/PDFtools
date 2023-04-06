<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class homeapge extends Controller
{
    public function Homepage()
    {
        if (session()->has('role')) {
            $redirectUrl = (session()->get('role') === 'admin') ? '/admin' : '/home';
            return redirect($redirectUrl);
        } else {
            return view('Homepage');
        }
    }
}
