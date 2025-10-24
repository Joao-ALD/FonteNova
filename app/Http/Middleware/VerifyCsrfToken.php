<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

/**
 * Middleware to verify the CSRF token.
 *
 * This middleware provides protection against Cross-Site Request Forgery (CSRF)
 * attacks by ensuring that incoming POST, PUT, PATCH, and DELETE requests
 * contain a valid CSRF token. The $except property can be used to exclude
 * specific URIs from CSRF verification.
 */
class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
}
