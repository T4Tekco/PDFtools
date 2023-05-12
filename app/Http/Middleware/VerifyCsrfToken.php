<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'auth/facebook/callback',
        'auth/google/callback',
        '/api/process-file',
        '/api/pdf-to-word',
        '/api/word-to-pdf',
        '/api/txt-to-json',
        '/api/pdf-to-txt',
        '/login'
    ];
    protected $addHttpCookie = true;

}
