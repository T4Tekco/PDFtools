<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class accountAdmin extends Controller
{
    public function index()
    {
        $user = new User();
        $userdata = $user->getoneuser(session()->get('ID'));
        return view('admin/profile', ['user' => $userdata]);
    }
}
