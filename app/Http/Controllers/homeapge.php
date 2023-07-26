<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class homeapge extends Controller
{
    public function Homepage()
    {
        return response()->json([
            'status' => '100',
            'output' => null,
            'error' => '',
            // 'token' => Str::random(80)
        ], 400);
    }
}
