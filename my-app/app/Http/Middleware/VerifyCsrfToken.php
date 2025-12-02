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
        // '/posts/create/normalsql',
        // '/posts/update/normalsql',
        // '/posts/delete/normalsql',

        // '/posts/create/bulk',
        // '/posts/create/querybuilder',
        // '/posts/update/querybuilder',
        // '/posts/delete/querybuilder',

        // '/posts/create/eloquent',
        // '/posts/update/eloquent',
        // '/posts/delete/eloquent/*',
    ];
}
